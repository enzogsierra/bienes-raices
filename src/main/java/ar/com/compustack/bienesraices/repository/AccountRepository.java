package ar.com.compustack.bienesraices.repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import ar.com.compustack.bienesraices.model.Account;


public interface AccountRepository extends JpaRepository<Account, Integer> {
    Optional<Account> findByUsername(String username);
}
