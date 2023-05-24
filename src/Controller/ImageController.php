<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageController extends AbstractController
{

    public function uploadImage($uploadedFile){
    

            $destination = $this->getParameter('app.upload_directory');
            $fileName = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move($destination, $fileName);
    
            // Construir la ruta de la imagen
            $imagePath = '/custom/imagenes/' . $fileName;
    
            // Guardar la ruta de la imagen en la base de datos

            return $imagePath;

    }
}
