CREATE SCHEMA banco_bd;

CREATE TABLE tarjetas(
idTarjeta INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
Num_Tarjeta VARCHAR (128) NOT NULL, 
franquicia VARCHAR (30) ,
token CHAR(18) NOT NULL,
fechaCreacion date NOT NULL
);

CREATE TABLE historialSolicitud(
idHistoria  INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
ipHistoria VARCHAR (20) NOT NULL,
tarjetaHistoria VARCHAR (128) NOT NULL, 
fechaHistoria datetime,
cantidadHistoria TINYINT(2)
);

CREATE INDEX ix_some_id ON tarjetas (Num_Tarjeta);
CREATE TABLE pago(
idPago INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
num_tarjetaPago VARCHAR (128) NOT NULL,
montoPago  INT(10) NOT NULL,
fechaPago date NOT NULL,
clientePago Varchar(120),
FOREIGN KEY (num_tarjetaPago)
  REFERENCES banco_bd.tarjetas (Num_Tarjeta)
);

