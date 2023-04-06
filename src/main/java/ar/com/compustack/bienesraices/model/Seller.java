package ar.com.compustack.bienesraices.model;

import java.util.ArrayList;
import java.util.List;

import javax.persistence.CascadeType;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.validation.constraints.NotBlank;
import javax.validation.constraints.Size;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import lombok.ToString;


@Entity
@Table(name = "sellers")
@Getter @Setter @ToString
@NoArgsConstructor @AllArgsConstructor
public class Seller 
{
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    @NotBlank(message = "Ingresa el nombre del vendedor")
    @Size(min = 3, max = 32, message = "El nombre del vendedor debe tener entre 3 y 32 caracteres")
    private String name;

    @NotBlank(message = "Ingresa el apellido del vendedor")
    @Size(min = 3, max = 32, message = "El apellido del vendedor debe tener entre 3 y 32 caracteres")
    private String surname;

    @NotBlank(message = "Ingresa el número de teléfono del vendedor")
    @Size(max = 16, message = "El número de teléfono del vendedor no puede superar los 16 caracteres")
    private String phoneNumber;

    @OneToMany(mappedBy = "seller", cascade = CascadeType.ALL, orphanRemoval = true)
    private List<Property> properties = new ArrayList<>();
}
