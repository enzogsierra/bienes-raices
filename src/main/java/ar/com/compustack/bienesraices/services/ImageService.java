package ar.com.compustack.bienesraices.services;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.Paths;
import java.util.Optional;
import java.util.UUID;

import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;


@Service
public class ImageService 
{
    private final String resourcesFolder = "assets//"; // Carpeta raíz donde se guardan todos los recursos, incluido imagenes

    public String save(MultipartFile file, String folder) throws IOException
    {
        if(!file.isEmpty()) // Imagen existente
        {
            // Generar un nombre de archivo para la imagen
            final String ext = getFileExtension(file.getOriginalFilename()).get(); // Obtener extension de la imagen
            final String filename = UUID.randomUUID().toString() + ext; // Nombre que tendrá el archivo - creamos un string unico anexando la extension de la imagen

            // Guardar imagen
            byte[] bytes = file.getBytes();
            Path path = Paths.get(resourcesFolder + folder + filename);
            Files.write(path, bytes);

            return filename;
        }
        else throw new IOException("No se encontró un archivo de imagen");
    }

    public void delete(String filename)
    {
        File file = new File(resourcesFolder + filename);
        file.delete();
    }

    private Optional<String> getFileExtension(String filename) // Devuelve la extension de un archivo ('.png', '.jpeg', '.mp3', etc)
    {
        return Optional.ofNullable(filename)
            .filter(str -> str.contains("."))
            .map(str -> str.substring(filename.lastIndexOf(".")));
    }
}
