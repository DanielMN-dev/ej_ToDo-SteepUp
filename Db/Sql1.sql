CREATE DATABASE gestor_tareas;
USE gestor_tareas;

CREATE TABLE usuarios
(
    ide_usu INT AUTO_INCREMENT PRIMARY KEY,
    nom_usu VARCHAR(100) NOT NULL,
    cor_usu VARCHAR(100) UNIQUE NOT NULL,
    con_usu VARCHAR(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE tareas (
    ide_tar INT AUTO_INCREMENT PRIMARY KEY,
    ide_usu INT,
    titulo_tar VARCHAR(255),
    des_tar TEXT,
    est_tar ENUM('pendiente', 'completado') DEFAULT 'pendiente',
    fec_tar TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ide_usu) REFERENCES usuarios(ide_usu) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;