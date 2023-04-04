package ar.com.compustack.bienesraices.config;


import java.util.ArrayList;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.GrantedAuthority;
import org.springframework.security.core.authority.SimpleGrantedAuthority;
import org.springframework.security.core.userdetails.User;
import org.springframework.security.core.userdetails.UserDetails;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import org.springframework.stereotype.Service;

import ar.com.compustack.bienesraices.model.Account;
import ar.com.compustack.bienesraices.repository.AccountRepository;


@Service
public class UserDetailsServiceImpl implements UserDetailsService 
{
    @Autowired
    private AccountRepository accountRepository;


    @Override
    public UserDetails loadUserByUsername(String username) throws UsernameNotFoundException 
    {
        Optional<Account> opt = accountRepository.findByUsername(username);

        if(opt.isPresent())
        {
            Account account = opt.get();
            
            // Crear objeto de roles
            List<GrantedAuthority> roleList = new ArrayList<>();
            GrantedAuthority role = new SimpleGrantedAuthority(account.getRole()); // Crear lista de roles, en este sistema los usuarios solo tienen 1 rol
            roleList.add(role); // Añadir el rol del usuario
            
            return new User(account.getUsername(), account.getPassword(), roleList); // Retornar usuario
        }
        
        throw new UsernameNotFoundException("Usuario no encontrado");
    }
}
