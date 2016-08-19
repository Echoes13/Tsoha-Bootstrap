<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

    public function update_errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $errors = array_merge($errors, $this->{$validator}());
      }

      // Poistetaan viesti listasta joka tarkistaa id:n
      unset($errors[0]);

      return $errors;
    }


    public function validate_name_length($name, $length_min, $length_max){
      $errors = array();
      if($name == '' || $name == null){
        $errors[] = 'Nimi ei saa jäädä tyhjäksi!';
      }
      if(strlen($name) < $length_min){
        $errors[] = 'Nimen pituuden täytyy olla vähintään ' . $length_min . ' merkkiä!';
      }
      if(strlen($name) > $length_max){
        $errors[] = 'Nimen pituus saa olla korkeintaan ' . $length_max . ' merkkiä!';
      }

      return $errors;
    }

  }
