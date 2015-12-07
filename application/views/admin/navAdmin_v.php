

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area"> 
      <li class="name"> 
        <h1><a href="">Espace administration</a> </h1> 
      </li> 
      <li class="toggle-topbar menu-icon">
       <a href="#"><span>Menu</span></a></li>
    </ul> 


    <section class="top-bar-section"> 
    <ul class="left">

    <li class="has-dropdown">
      <a href="#">Gestion des commandes</a>
  
      <ul class="dropdown"> 
        <li><a  href="<?php echo site_url('Commande_c/displayCommandeAdmin');?>" > consulter et préparer les commandes</a></li>
        <li><a href="<?php echo site_url('Commande_c/administrationCommande');?>" >afficher/editer/supprimer des commandes</a></li>
      </ul>
    </li>

    <li class="has-dropdown">
      <a href="#">Gestion des produits</a> 
      <ul class="dropdown"> 
        <li><a  href="<?php echo site_url('Produit_c');?>" >afficher/editer/supprimer les produits</a></li>
        <li><a class="SousMenu" href="<?php echo site_url('Produit_c/creerProduit');?>" > créer un produit</a></li>  
      </ul>
    </li>

    <li class="has-dropdown">
     <a href="#">Gestion des clients</a> 
      <ul class="dropdown fixed"> 
        <li><a  href="<?php echo site_url('Client_c/displayClients');?>" >afficher/editer/supprimer des clients</a></li>
        <li><a  href="<?php echo site_url('Produit_c/creerProduit');?>" > créer un client</a></li>  
      </ul>
    </li>

    </ul>
    
    <ul class="right"> 
    <li><a href="<?php echo site_url('users_c/deconnexion');?>">se deconnecter</a></li> 
    </ul> 
    </section> 
</nav>
