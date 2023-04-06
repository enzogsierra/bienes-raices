package ar.com.compustack.bienesraices.repository;

import java.util.List;

import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;

import ar.com.compustack.bienesraices.model.Property;


public interface PropertyRepository extends JpaRepository<Property, Integer> 
{
    @Query("SELECT p FROM Property p")
    List<Property> findLimitedProperties(Pageable pageable);
}
