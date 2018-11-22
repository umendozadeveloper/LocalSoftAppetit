<?php
 if (session_id()==""){
     session_start();
 }

class Seguridad
{
  private $id_usuario;
  private $id_perfil;
  private $username;
  private $isloggedin;
  
  //permiso para comandear sistema soft-appetit
  private $comandear;
  
  private $vip;
          
    function __construct() 
    {
      $this->id_usuario = isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']: 0;
      $this->id_perfil = isset($_SESSION['id_perfil'])?$_SESSION['id_perfil']: 0;
      $this->username = isset($_SESSION['username'])?$_SESSION['username']: "";
      $this->isloggedin = isset($_SESSION['isloggedin'])?$_SESSION['isloggedin']: FALSE;
      $this->comandear = isset($_SESSION['comandear'])?$_SESSION['comandear']: FALSE;
      $this->vip = isset($_SESSION['vip'])?$_SESSION['vip']: FALSE;
    }
  function __destruct() {
      
  }
  function asigna ($id_usuario, $id_perfil, $username, $id_otro_usuario = 99, $logueado = TRUE,$comandear = false,$vip=false)
  {
      $_SESSION['id_usuario'] = $id_usuario;
      $_SESSION['id_perfil'] = $id_perfil;
      $_SESSION['username'] = $username;
      $_SESSION['isloggedin'] = $logueado;
      $_SESSION['id_otro']=$id_otro_usuario;
      $_SESSION['comandear'] = $comandear;
      $_SESSION['vip']=$vip;
      
  }
  
  function asignaComandearMesero ($id_usuario, $id_perfil, $username, $id_otro_usuario = 99, $logueado = TRUE,$comandear = true,$vip=false)
  {
      $_SESSION['id_usuario'] = $id_usuario;
      $_SESSION['id_perfil'] = $id_perfil;
      $_SESSION['username'] = $username;
      $_SESSION['isloggedin'] = $logueado;
      $_SESSION['id_otro']=$id_otro_usuario;
      $_SESSION['comandear'] = $comandear;
      $_SESSION['vip']=$vip;
      
  }
  
  
  function isLoggedIn ()
  {
      return isset($_SESSION['isloggedin'])?$_SESSION['isloggedin']: FALSE;
  }
  function CurrentUserID()
  {
      return isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']: 0;
  }
  function CurrentUserName()
  {
      return $this->username = isset($_SESSION['username'])?$_SESSION['username']: "";
  }
  function CurrentUserPerfil()
  {
     return isset($_SESSION['id_perfil'])?$_SESSION['id_perfil']: 0;
  }
  
  function CurrentOtroUsuario()
  {
     return isset($_SESSION['id_otro'])?$_SESSION['id_otro']: 0;
  }
  
  function CurrentPermisoComandear()
  {
     return isset($_SESSION['comandear'])?$_SESSION['comandear']: FALSE;
  }
  
  function EsVIP()
  {
//     return isset($_SESSION['vip'])?$_SESSION['vip']: FALSE;
  }
  
  function Destruye()
  {
      unset($_SESSION['id_usuario']);
      unset($_SESSION['id_perfil']);
      unset($_SESSION['username']);
      unset($_SESSION['isloggedin']);
      unset($_SESSION['comandear']);
      unset($_SESSION['vip']);
  }
}
?>