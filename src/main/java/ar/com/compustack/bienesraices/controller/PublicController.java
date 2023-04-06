package ar.com.compustack.bienesraices.controller;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;

import ar.com.compustack.bienesraices.model.Property;
import ar.com.compustack.bienesraices.repository.PropertyRepository;


@Controller
public class PublicController
{
    @Autowired
    private PropertyRepository propertyRepository;


    @GetMapping("/")
    public String index(Model model)
    {
        Pageable pageable = PageRequest.of(0, 3);
        List<Property> properties = propertyRepository.findLimitedProperties(pageable);

        model.addAttribute("properties", properties);
        return "public/index";
    }

    @GetMapping("/propiedades")
    public String advertisedProperties(Model model)
    {
        model.addAttribute("properties", propertyRepository.findAll());
        return "public/propiedades";
    }

    @GetMapping("/propiedad/{id}")
    public String property(@PathVariable Integer id, Model model)
    {
        Optional<Property> property = propertyRepository.findById(id);
        if(!property.isPresent())
        {
            return "redirect:/propiedades";
        }

        model.addAttribute("property", property.get());
        return "public/propiedad";
    }

    @GetMapping("/nosotros")
    public String us()
    {
        return "public/nosotros";
    }

    @GetMapping("/blog")
    public String blog()
    {
        return "public/blog";
    }

    @GetMapping("/entrada")
    public String entry()
    {
        return "public/entrada";
    }

    @GetMapping("/contacto")
    public String contact()
    {
        return "public/contacto";
    }
}
