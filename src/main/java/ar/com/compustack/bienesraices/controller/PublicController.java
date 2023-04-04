package ar.com.compustack.bienesraices.controller;

import java.security.Principal;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ResponseBody;


@Controller
public class PublicController
{
    @GetMapping("/")
    public String index(Principal principal)
    {
        System.out.println("DATOS: " + principal.toString());

        return "public/index";
    }


    @GetMapping("/api")
    public @ResponseBody String api()
    {
        return "Hello world!";
    }
}
