---------TBL_ROLES--------------
CREATE OR REPLACE PACKAGE PKG_ROLES
AS
--ELIMINAR
PROCEDURE ELIMINAR_ROL(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_ROL(ROL NUMBER, VNOM VARCHAR2);

--INSERTAR
PROCEDURE INSERTAR_ROL(VNOMBRE VARCHAR2);

END;


CREATE OR REPLACE PACKAGE BODY PKG_ROLES
AS
--ELIMINAR
PROCEDURE ELIMINAR_ROL(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_ROLES WHERE ID_ROL=VID; 
 COMMIT;
END;

--ACTUALIZAR 
PROCEDURE ACTUALIZAR_ROL(ROL NUMBER, VNOM VARCHAR2)
AS 
BEGIN
 UPDATE TBL_ROLES SET NOMBRE=VNOM WHERE ID_ROL = ROL;
 COMMIT;
END;

--INSERTAR
PROCEDURE INSERTAR_ROL(VNOMBRE VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_ROLES (NOMBRE) VALUES (VNOMBRE);
  COMMIT;
END;

END PKG_ROLES;

-------FIN TBL_ROLES---------------------



--------TBL_DISTRIBUIDORES---------------

CREATE OR REPLACE PACKAGE PKG_DISTRIBUIDOR
AS 
--ELIMINAR
PROCEDURE ELIMINAR_DISTRIBUIDOR(VID NUMBER);

--ACTUALIZAR 
PROCEDURE ACTUALIZAR_DISTRIBUIDOR(VID NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VDIREC VARCHAR2, VTELE NUMBER);

--INSERTAR 
PROCEDURE INSERTAR_DISTRIBUIDOR(VNOM VARCHAR2, VAPE VARCHAR2, VDIREC VARCHAR2, VTELE NUMBER);

END;

CREATE OR REPLACE PACKAGE BODY PKG_DISTRIBUIDOR
AS 

--ELIMINAR
PROCEDURE ELIMINAR_DISTRIBUIDOR(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_DISTRIBUIDOR WHERE ID_DISTRIBUIDOR=VID; 
 COMMIT;
END;

--ACTUALIZAR
PROCEDURE ACTUALIZAR_DISTRIBUIDOR(VID NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VDIREC VARCHAR2, VTELE NUMBER)
AS 
BEGIN
 UPDATE TBL_DISTRIBUIDOR SET NOMBRE=VNOM, APELLIDO=VAPE, DIRECCION=VDIREC, TELEFONO=VTELE WHERE ID_DISTRIBUIDOR = VID;
 COMMIT;
END;

--INSERTAR 
PROCEDURE INSERTAR_DISTRIBUIDOR(VNOM VARCHAR2, VAPE VARCHAR2, VDIREC VARCHAR2, VTELE NUMBER)
AS
BEGIN 
  INSERT INTO TBL_DISTRIBUIDOR (NOMBRE, APELLIDO, DIRECCION, TELEFONO) VALUES (VNOM, VAPE, VDIREC, VTELE);
  COMMIT;
END;

END PKG_DISTRIBUIDOR;

--------FIN TBL_DISTRIBUIDORES-----------

--------TBL_FLORES---------------FALTA DE REVISAR
CREATE OR REPLACE PACKAGE PKG_FLORES
AS

--ELIMINAR
PROCEDURE ELIMINAR_FLORES(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_FLORES(VID NUMBER, VNOM VARCHAR2, VTIPO VARCHAR2, VDETA VARCHAR2);

--INSERTAR
PROCEDURE INSERTAR_FLORES(VNOM VARCHAR2, VTIPO VARCHAR2, VDETA VARCHAR2);

END;

CREATE OR REPLACE PACKAGE BODY PKG_FLORES
AS

--ELIMINAR
PROCEDURE ELIMINAR_FLORES(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_FLORES WHERE ID_FLOR=VID; 
 COMMIT;
END;

--ACTUALIZAR 
PROCEDURE ACTUALIZAR_FLORES(VID NUMBER, VNOM VARCHAR2, VTIPO VARCHAR2, VDETA VARCHAR2)
AS 
BEGIN
 UPDATE TBL_FLORES SET NOMBRE=VNOM, TIPO=VTIPO, DETALLE=VDETA WHERE ID_FLOR = VID;
 COMMIT;
END;

--INSERTAR
PROCEDURE INSERTAR_FLORES(VNOM VARCHAR2, VTIPO VARCHAR2, VDETA VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_FLORES (NOMBRE, TIPO, DETALLE) VALUES (VNOM, VTIPO, VDETA);
  COMMIT;
END;

END PKG_FLORES;

--------FIN TBL_FLORES-----------

--------TBL_INVENTARIOS---------------funciona

CREATE OR REPLACE PACKAGE PKG_INVENTARIOS
AS
--ELIMINAR 
PROCEDURE ELIMINAR_INVENTARIO(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_INVENTARIO(VID NUMBER, VFLOR NUMBER, VVIDA_UTIL VARCHAR2, VCANT NUMBER, VFECHA_CORTE VARCHAR2, VESTADO VARCHAR2);

--INSERTAR 
PROCEDURE INSERTAR_INVENTARIO(VFLOR NUMBER, VVIDA_UTIL VARCHAR2, VCANT NUMBER, VFECHA_CORTE VARCHAR2, VESTADO VARCHAR2);

END;

CREATE OR REPLACE PACKAGE BODY PKG_INVENTARIOS
AS
--ELIMINAR
PROCEDURE ELIMINAR_INVENTARIO(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_INVENTARIOS WHERE ID_INVENTARIO=VID; 
 COMMIT;
END;

--ACTUALIZAR
PROCEDURE ACTUALIZAR_INVENTARIO(VID NUMBER, VFLOR NUMBER, VVIDA_UTIL VARCHAR2, VCANT NUMBER, VFECHA_CORTE VARCHAR2, VESTADO VARCHAR2)
AS 
BEGIN
 UPDATE TBL_INVENTARIOS SET ID_FLOR=VFLOR, VIDA_UTIL=VVIDA_UTIL, CANTIDAD_ROLLOS=VCANT, FECHA_CORTE=VFECHA_CORTE, ESTADO=VESTADO WHERE ID_INVENTARIO = VID;
 COMMIT;
END;

--INSERTAR 
PROCEDURE INSERTAR_INVENTARIO(VFLOR NUMBER, VVIDA_UTIL VARCHAR2, VCANT NUMBER, VFECHA_CORTE VARCHAR2, VESTADO VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_INVENTARIOS (ID_FLOR, VIDA_UTIL, CANTIDAD_ROLLOS, FECHA_CORTE, ESTADO) VALUES (VFLOR, VVIDA_UTIL, VCANT, VFECHA_CORTE, VESTADO);
  COMMIT;
END;

END PKG_INVENTARIOS;


--------FIN TBL_INVENTARIOS-----------

--------TBL_PEDIDOS---------------FUNCIONES

CREATE OR REPLACE PACKAGE PKG_PEDIDOS
AS
--ELIMINAR 
PROCEDURE ELIMINAR_PEDIDOS(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_PEDIDOS(VID NUMBER, VFLOR NUMBER, VCANT NUMBER, VFECHA_ENTREGA VARCHAR2, VFECHA_PEDIDO VARCHAR2);

--INSERTAR 
PROCEDURE INSERTAR_PEDIDOS(VFLOR NUMBER, VCANT NUMBER, VFECHA_ENTREGA VARCHAR2, VFECHA_PEDIDO VARCHAR2);
END;

CREATE OR REPLACE PACKAGE BODY PKG_PEDIDOS
AS
--ELIMINAR
PROCEDURE ELIMINAR_PEDIDOS(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_PEDIDOS WHERE ID_PEDIDO=VID; 
 COMMIT;
END;

--ACTUALIZAR 
PROCEDURE ACTUALIZAR_PEDIDOS(VID NUMBER, VFLOR NUMBER, VCANT NUMBER, VFECHA_ENTREGA VARCHAR2, VFECHA_PEDIDO VARCHAR2)
AS 
BEGIN
 UPDATE TBL_PEDIDOS SET ID_FLOR=VFLOR, CANTIDAD=VCANT, FECHA_ENTREGA=VFECHA_ENTREGA, FECHA_PEDIDO=VFECHA_PEDIDO WHERE ID_PEDIDO = VID;
 COMMIT;
END;

--INSERTAR
PROCEDURE INSERTAR_PEDIDOS(VFLOR NUMBER, VCANT NUMBER, VFECHA_ENTREGA VARCHAR2, VFECHA_PEDIDO VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_PEDIDOS (ID_FLOR, CANTIDAD, FECHA_ENTREGA, FECHA_PEDIDO) VALUES (VFLOR, VCANT, VFECHA_ENTREGA, VFECHA_PEDIDO );
  COMMIT;
END;

END PKG_PEDIDOS;




--------FIN TBL_PEDIDOS-----------


-------TBL_USUARIOS---------------FUNCIONA

CREATE OR REPLACE PACKAGE PKG_USUARIOS
AS
--ELIMINAR
PROCEDURE ELIMINAR_USUARIO(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_USUARIO(VID NUMBER, VROL NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VUSUARIO VARCHAR2, VPASS VARCHAR2);

--INSERTAR
PROCEDURE INSERTAR_USUARIO(VROL NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VUSUARIO VARCHAR2, VPASS VARCHAR2);

END;

CREATE OR REPLACE PACKAGE BODY PKG_USUARIOS
AS

--ELIMINAR
PROCEDURE ELIMINAR_USUARIO(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_USUARIOS WHERE ID_USUARIO=VID; 
 COMMIT;
END;

--ACTUALIZAR
PROCEDURE ACTUALIZAR_USUARIO(VID NUMBER, VROL NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VUSUARIO VARCHAR2, VPASS VARCHAR2)
AS 
BEGIN
 UPDATE TBL_USUARIOS SET ID_ROL=VROL, NOMBRE=VNOM, APELLIDO=VAPE, NOMBRE_USUARIO=VUSUARIO, PASS=VPASS WHERE ID_USUARIO = VID;
 COMMIT;
END;

--INSERTAR
PROCEDURE INSERTAR_USUARIO(VROL NUMBER, VNOM VARCHAR2, VAPE VARCHAR2, VUSUARIO VARCHAR2, VPASS VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_USUARIOS (ID_ROL, NOMBRE, APELLIDO, NOMBRE_USUARIO, PASS) VALUES (VROL, VNOM, VAPE, VUSUARIO, VPASS);
  COMMIT;
END;

END PKG_USUARIOS;

------FIN TBL_USUARIOS------------

------TBL_VENTAS------------------
CREATE OR REPLACE PACKAGE PKG_VENTAS
AS

--ELIMINAR
PROCEDURE ELIMINAR_VENTAS(VID NUMBER);

--ACTUALIZAR
PROCEDURE ACTUALIZAR_VENTAS(VID NUMBER, VFLOR NUMBER, VUSUARIO NUMBER, VCLIENTE VARCHAR2, VCANT NUMBER, VFECHA_VENTA VARCHAR2);

--INSERTAR
PROCEDURE INSERTAR_VENTAS(VFLOR NUMBER, VUSUARIO NUMBER, VCLIENTE VARCHAR2, VCANT NUMBER, VFECHA_VENTA VARCHAR2);

END;

CREATE OR REPLACE PACKAGE BODY PKG_VENTAS
AS
--ELIMINAR
PROCEDURE ELIMINAR_VENTAS(VID NUMBER)
AS 
BEGIN
 DELETE FROM TBL_VENTAS WHERE ID_VENTAS=VID; 
 COMMIT;
END;

--ACTUALIZAR
PROCEDURE ACTUALIZAR_VENTAS(VID NUMBER, VFLOR NUMBER, VUSUARIO NUMBER, VCLIENTE VARCHAR2, VCANT NUMBER, VFECHA_VENTA VARCHAR2)
AS 
BEGIN
 UPDATE TBL_VENTAS SET ID_VENTAS=VFLOR, ID_USUARIO=VUSUARIO, NOMBRE_CLIENTE=VCLIENTE, CANTIDAD=VCANT, FECHA_VENTA=VFECHA_VENTA WHERE ID_VENTAS = VID;
 COMMIT;
END;

--INSERTAR 
PROCEDURE INSERTAR_VENTAS(VFLOR NUMBER, VUSUARIO NUMBER, VCLIENTE VARCHAR2, VCANT NUMBER, VFECHA_VENTA VARCHAR2)
AS
BEGIN 
  INSERT INTO TBL_VENTAS (ID_FLOR, ID_USUARIO, NOMBRE_CLIENTE, CANTIDAD, FECHA_VENTA) VALUES (VFLOR, VUSUARIO, VCLIENTE, VCANT, VFECHA_VENTA);
  COMMIT;
END;

END PKG_VENTAS;

------FIN DE TBL_VENTAS-----------
