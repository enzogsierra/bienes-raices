package ar.com.compustack.bienesraices.controller;

import java.util.Optional;

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.validation.ObjectError;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import ar.com.compustack.bienesraices.model.Account;
import ar.com.compustack.bienesraices.repository.AccountRepository;


@Controller
public class AuthController 
{
    @Autowired
    private AccountRepository accountRepository;

    private BCryptPasswordEncoder passwordEncoder = new BCryptPasswordEncoder();


    @GetMapping("/login")
    public String loginForm()
    {
        return "public/login";
    }


    @GetMapping("/signup")
    public String signup(Model model)
    {
        model.addAttribute("account", new Account());
        return "public/signup";
    }

    @PostMapping("/signup")
    public String signup_POST(@Valid Account account, BindingResult result, Model model)
    {
        // Verificar si el nombre de usuario ya existe
        Optional<Account> checkUsername = accountRepository.findByUsername(account.getUsername());
        if(checkUsername.isPresent())
        {
            result.addError(new ObjectError("usernameExists", "Este nombre de usuario ya existe. ¿Deseas iniciar sesión?"));
            return "public/signup";
        }

        // Verificar errores de formulario
        if(result.hasErrors())
        {
            return "public/signup";
        }

        // Registro correcto
        account.setRole("USER"); // Rol por default
        account.setPassword(passwordEncoder.encode(account.getPassword())); // Codificar la contraseña
        accountRepository.save(account);

        return "redirect:/login";
    }
}
