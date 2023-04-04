package ar.com.compustack.bienesraices.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.web.SecurityFilterChain;


@Configuration
@EnableWebSecurity
public class SecurityConfig 
{
    @Bean
    public static BCryptPasswordEncoder getEncoder()
    {
        return new BCryptPasswordEncoder();
    }


    @Bean
    public SecurityFilterChain filterChain(HttpSecurity http) throws Exception
    {
        return http
            .csrf().disable()
            .authorizeHttpRequests(auth ->
            {
                auth.antMatchers("/admin/**").hasRole("ADMIN");
                auth.anyRequest().permitAll();
            })
            .formLogin(form ->
            {
                form.loginPage("/login");
                form.loginProcessingUrl("/login");
                form.defaultSuccessUrl("/");
                form.permitAll();
            })
            .logout(logout ->
            {
                logout.logoutUrl("/logout");
                logout.logoutSuccessUrl("/");
                logout.permitAll();
            })
            .build();
    }
}
