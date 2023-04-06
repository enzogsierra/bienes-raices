package ar.com.compustack.bienesraices.model;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;
import javax.validation.constraints.Size;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import lombok.ToString;


@Entity
@Table(name = "accounts")
@Getter @Setter @ToString
@NoArgsConstructor @AllArgsConstructor
public class Account 
{
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;   

    @Column(length = 32, unique = true)
    @Size(min = 4, max = 32, message = "El nombre de usuario debe tener entre 4 y 32 caracteres")
    private String username;
    
    @Size(min = 4, message = "La contraseña debe tener un mínimo de 4 caracteres")
    private String password;

    private String role;
}
