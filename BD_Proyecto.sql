create table tbl_Distribuidor(Id_Distribuidor number not null, Nombre varchar2(30)not null,
Apellido varchar2(50)not null, Direccion varchar2(20)not null, Telefono number not null, primary key(Id_Distribuidor));

create table tbl_Usuarios( Id_Usuario number not null, Id_Rol number not null, constraint Rol_fk foreign key(Id_Rol) references tbl_Roles(Id_Rol),
Nombre varchar2(30) not null, Apellido varchar2(30) not null,
Nombre_Usuario varchar2(30) not null, Contraseña varchar2(30) not null, primary key(Id_Usuario));

create table tbl_Roles(Id_Rol number not null, nombre varchar2(30)not null, primary key(Id_Rol));

create table tbl_Flores(Id_Flor number not null, Nombre varchar2(30) not null, 
Tipo varchar2(30) not null, Detalle varchar2(50) not null, primary key(Id_Flor));

create table tbl_Ventas(Id_Ventas number not null,Id_Inventario number not null, Id_Usuario number not null, Nombre_Cliente varchar2(50)not null, Cantidad number not null, Fecha_Venta date not null,
constraint inventario_fk foreign key(Id_Inventario) references tbl_Inventario(Id_Inventario), constraint usuario_fk foreign key(Id_Usuario) references tbl_Usuarios(Id_Usuario), primary key(Id_Ventas));

create table tbl_Pedidos(Id_Pedido number not null, Id_Flor number not null, Cantidad number not null, Fecha_Entrega date not null, 
Fecha_Pedido date not null, constraint flor2_fk foreign key(Id_Flor) references tbl_Flores(Id_Flor), primary key(Id_Pedido));

create table tbl_Inventarios(Id_Inventario number not null, Id_Flor number not null, Vida_Util varchar2(30)not null, Cantidad_Rollos number not null, Fecha_Corte date not null, Estado varchar2(30),
constraint flor3_fk foreign key(Id_Flor) references tbl_Flores(Id_Flor), primary key(Id_Inventario));