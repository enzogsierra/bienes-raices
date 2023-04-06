package ar.com.compustack.bienesraices.model;

import java.time.LocalDate;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.validation.Valid;
import javax.validation.constraints.Min;
import javax.validation.constraints.NotNull;
import javax.validation.constraints.Size;

import org.springframework.format.annotation.NumberFormat;
import org.springframework.format.annotation.NumberFormat.Style;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;


@Entity
@Table(name = "properties")
@Getter @Setter
@NoArgsConstructor @AllArgsConstructor
public class Property 
{
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    @Column(length = 128)
    @Size(min = 16, max = 128, message = "El título de la propiedad debe tener entre 16 y 128 caracteres")
    private String title;

    @Column(length = 512)
    @Size(min = 16, max = 512, message = "La descripción de la propiedad debe tener entre 16 y 512 caracteres")
    private String description;

    @NotNull(message = "Debes indicar el precio de la propiedad")
    @NumberFormat(pattern = "#,###.##", style = Style.CURRENCY)
    @Min(value = 1, message = "El precio de la propiedad debe ser mayor a $1")
    private double price;

    private String imageName;

    @Min(value = 1, message = "La propiedad debe tener al menos 1 habitación")
    private Integer rooms;

    @Min(value = 1, message = "La propiedad debe tener al menos 1 baño")
    private Integer bathrooms;

    @Min(value = 0, message = "Indica una cantidad válida de estacionamientos")
    private Integer parkingLots;
    
    @Valid
    @NotNull(message = "Debes especificar al vendedor de esta propiedad")
    @ManyToOne(optional = false)
    @JoinColumn(name = "seller_id", referencedColumnName = "id")
    private Seller seller;
    
    private LocalDate createdAt;

    @Override
    public String toString() {
        return "Property [id=" + id + ", title=" + title + ", description=" + description + ", price=" + price
                + ", imageName=" + imageName + ", rooms=" + rooms + ", bathrooms=" + bathrooms + ", parkingLots="
                + parkingLots + ", createdAt=" + createdAt + "]";
    }
}
