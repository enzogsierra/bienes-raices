package ar.com.compustack.bienesraices.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;


@Controller
public class PublicController
{
    @GetMapping("/")
    public String index()
    {
        return "public/index";
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

    @GetMapping("/contacto")
    public String contact()
    {
        return "public/contacto";
    }
}
