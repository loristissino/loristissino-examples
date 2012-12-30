<?php

class Category
{
  private $id;
  private $name;
  private $rank;

  public function setId($v)
  {
      $this->id = $v;
      return $this;
  }  
  public function setName($v)
  {
      $this->name = $v;
      return $this;
  }  
  public function setRank($v)
  {
      $this->rank = $v;
      return $this;
  }  
  public function getId()
  {
      return $this->id;
  }  
  public function getName()
  {
      return $this->name;
  }  
  public function getRank()
  {
      return $this->rank;
  }  

}
