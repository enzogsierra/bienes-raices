package ar.com.compustack.bienesraices.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import ar.com.compustack.bienesraices.model.Property;


public interface PropertyRepository extends JpaRepository<Property, Integer> {
    
}
