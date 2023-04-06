package ar.com.compustack.bienesraices.controller;

import java.io.IOException;
import java.time.LocalDate;
import java.util.Optional;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.ObjectError;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

import ar.com.compustack.bienesraices.model.Property;
import ar.com.compustack.bienesraices.model.Seller;
import ar.com.compustack.bienesraices.repository.PropertyRepository;
import ar.com.compustack.bienesraices.repository.SellerRepository;
import ar.com.compustack.bienesraices.services.ImageService;


@Controller
@RequestMapping("/admin")
public class AdminController 
{
    @Autowired
    private PropertyRepository propertyRepository;

    @Autowired
    private SellerRepository sellerRepository;

    @Autowired
    private ImageService imageService;


    @GetMapping(value = {"", "/"})
    public String home(Model model)
    {
        model.addAttribute("properties", propertyRepository.findAll());
        model.addAttribute("sellers", sellerRepository.findAll());
        return "admin/home";
    }

    // Propiedades
    @GetMapping("/nuevaPropiedad")
    public String newProperty(Model model)
    {
        model.addAttribute("property", new Property());
        model.addAttribute("sellers", sellerRepository.findAll());
        return "admin/propertyForm";
    }

    @GetMapping("/editarPropiedad/{id}")
    public String editProperty(@PathVariable Integer id, Model model, RedirectAttributes redirect)
    {
        Optional<Property> property = propertyRepository.findById(id); // Buscar propiedad por el ID proporcionado en la url
        if(!property.isPresent()) // El vendedor no existe
        {
            redirect.addFlashAttribute("errorMsg", "La propiedad que tratas de editar no existe");
            return "redirect:/admin";
        }

        model.addAttribute("property", property.get()); // Mostramos la vista del formulario con los datos de la propiedad
        model.addAttribute("sellers", sellerRepository.findAll());
        return "admin/propertyForm";
    }

    @PostMapping("/propertyPost")
    public String propertyPost(@Valid Property property, BindingResult result, @RequestParam("imageFile") MultipartFile imageFile, RedirectAttributes redirect, Model model) throws IOException
    {
        // Para nuevas propiedades, verificar que se esté proporcionando una imagen
        if(property.getId() == null && imageFile.isEmpty()) // Imagen vacia - no proporcionada
        {
            result.addError(new ObjectError("imageNotPresent", "Debes añadir una foto de la propiedad")); // Añadir error de validacion
        }

        // Verificar errores de validacion
        if(result.hasErrors())
        {
            model.addAttribute("sellers", sellerRepository.findAll());
            return "admin/propertyForm";
        }

        // Formulario validado
        final String imagesFolder = "properties/";

        if(property.getId() == null) // ID no existente, se está creando una propiedad
        {
            String filename = imageService.save(imageFile, imagesFolder); // Guardar imagen
            property.setImageName(filename); // Guardar url de la imagen de la propiedad

            property.setCreatedAt(LocalDate.now());
        } 
        else // Editando una propiedad
        {
            if(!imageFile.isEmpty()) // El usuario está cambiando la imagen (foto) de la propiedad
            {
                imageService.delete(imagesFolder + property.getImageName()); // Eliminar imagen anterior
    
                String filename = imageService.save(imageFile, imagesFolder); // Guardar nueva imagen
                property.setImageName(filename); // Actualizar la url de la imagen de la propiedad
            }
        }
        
        // Añadir atributo flash antes de guardar la propiedad, para saber si es una nueva propiedad o no
        redirect.addFlashAttribute("successMsg", (property.getId() == null) ? "Propiedad creada correctamente" : "Propiedad editada correctamente");

        // Guardar datos de la propiedad
        propertyRepository.save(property);
        return "redirect:/admin";
    }

    @PostMapping("/eliminarPropiedad")
    public String deleteProperty(@RequestParam Integer id, RedirectAttributes redirect)
    {
        Optional<Property> property = propertyRepository.findById(id); // Tratar de obtener el vendedor según el ID proporcionado desde el form
        if(!property.isPresent()) // Vendedor inexistente
        {
            return "redirect:/admin";
        }

        // Eliminar vendedor
        propertyRepository.delete(property.get());

        redirect.addFlashAttribute("successMsg", "Propiedad eliminada correctamente");
        return "redirect:/admin";
    }

    // Vendedores
    @GetMapping("/nuevoVendedor")
    public String newSeller(Model model)
    {
        model.addAttribute("seller", new Seller()); // Mostramos la vista del formulario vacía
        return "admin/sellerForm";
    }

    @GetMapping("/editarVendedor/{id}")
    public String editSeller(@PathVariable Integer id, Model model, RedirectAttributes redirect)
    {
        Optional<Seller> seller = sellerRepository.findById(id); // Buscar vendedor por el ID proporcionado en la url
        if(!seller.isPresent()) // El vendedor no existe
        {
            redirect.addFlashAttribute("errorMsg", "El vendedor que tratas de editar no existe");
            return "redirect:/admin";
        }

        model.addAttribute("seller", seller.get()); // Mostramos la vista del formulario con los datos del vendedor
        return "admin/sellerForm";
    }

    @PostMapping("/sellerPost")
    public String sellerPost(@Valid Seller seller, BindingResult result, RedirectAttributes redirect)
    {
        // Verificar errores de formulario
        if(result.hasErrors())
        {
            return "admin/sellerForm";
        }

        // Añadir atributo flash antes de guardar el vendedor, para saber si es un nuevo vendedor o no
        redirect.addFlashAttribute("successMsg", (seller.getId() == null) ? "Vendedor creado correctamente" : "Vendedor editado correctamente");

        // Crear/editar vendedor
        sellerRepository.save(seller);
        
        return "redirect:/admin";
    }

    @PostMapping("/eliminarVendedor")
    public String deleteSeller(@RequestParam Integer id, RedirectAttributes redirect)
    {
        Optional<Seller> seller = sellerRepository.findById(id); // Tratar de obtener el vendedor según el ID proporcionado desde el form
        if(!seller.isPresent()) // Vendedor inexistente
        {
            return "redirect:/admin";
        }

        // Eliminar vendedor
        sellerRepository.delete(seller.get());

        redirect.addFlashAttribute("successMsg", "Vendedor eliminado correctamente");
        return "redirect:/admin";
    }
}
