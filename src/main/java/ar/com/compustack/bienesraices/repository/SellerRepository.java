package ar.com.compustack.bienesraices.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import ar.com.compustack.bienesraices.model.Seller;


public interface SellerRepository extends JpaRepository<Seller, Integer> {
    
}
