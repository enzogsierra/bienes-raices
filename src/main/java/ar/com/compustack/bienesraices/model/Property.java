package ar.com.compustack.bienesraices.model;

import java.util.Date;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

import lombok.AllArgsConstructor;
import lombok.Getter;
import lombok.NoArgsConstructor;
import lombok.Setter;
import lombok.ToString;


@Entity
@Table(name = "properties")
@Getter @Setter @ToString 
@NoArgsConstructor @AllArgsConstructor
public class Property 
{
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    private String title;
    private String description;
    private double price;

    private String imageUrl;
    private Integer rooms;
    private Integer bathrooms;
    private Integer parkingLots;
    
    @ManyToOne
    private Seller seller;
    
    private Date createdAt;
}
