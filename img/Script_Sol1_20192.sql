/****** Object:  Table [dbo].[tbl_ciudad]    Script Date: 23-09-2019 18:16:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_ciudad](
	[ID_intCiudad] [int] IDENTITY(1,1) NOT NULL,
	[vchNomCiu] [varchar](50) NULL,
	[ID_intRegion] [int] NULL,
 CONSTRAINT [PK_tbl_ciudad] PRIMARY KEY CLUSTERED 
(
	[ID_intCiudad] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_cliente]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_cliente](
	[vchRut] [varchar](10) NOT NULL,
	[vchNombre] [varchar](50) NULL,
	[vchApePat] [varchar](50) NULL,
	[vchApeMat] [varchar](50) NULL,
	[ID_intComuna] [int] NULL,
 CONSTRAINT [PK_tbl_cliente] PRIMARY KEY CLUSTERED 
(
	[vchRut] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Comuna]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Comuna](
	[ID_intComuna] [int] IDENTITY(1,1) NOT NULL,
	[vchNomCom] [varchar](50) NULL,
	[ID_intCiudad] [int] NULL,
 CONSTRAINT [PK_tbl_Comuna] PRIMARY KEY CLUSTERED 
(
	[ID_intComuna] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_DetalleVenta]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_DetalleVenta](
	[ID_intDetalle] [int] IDENTITY(1,1) NOT NULL,
	[ID_intProducto] [int] NULL,
	[ID_intVenta] [int] NULL,
	[intCantidad] [int] NULL,
 CONSTRAINT [PK_tbl_DetalleVenta] PRIMARY KEY CLUSTERED 
(
	[ID_intDetalle] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Pais]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Pais](
	[ID_intPais] [int] IDENTITY(1,1) NOT NULL,
	[vchNomPais] [nchar](10) NULL,
 CONSTRAINT [PK_tbl_Pais] PRIMARY KEY CLUSTERED 
(
	[ID_intPais] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Producto]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Producto](
	[ID_intProducto] [int] IDENTITY(1,1) NOT NULL,
	[vchNomProd] [varchar](50) NULL,
	[intStock] [int] NULL,
	[intPrecio] [int] NULL,
 CONSTRAINT [PK_tbl_Producto] PRIMARY KEY CLUSTERED 
(
	[ID_intProducto] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Region]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Region](
	[ID_intRegion] [int] IDENTITY(1,1) NOT NULL,
	[vchNomReg] [varchar](50) NULL,
	[ID_intPais] [int] NULL,
 CONSTRAINT [PK_tbl_Region] PRIMARY KEY CLUSTERED 
(
	[ID_intRegion] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_TipoVenta]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_TipoVenta](
	[ID_intTipoVta] [int] IDENTITY(1,1) NOT NULL,
	[vchNomTipoVta] [varchar](50) NULL,
 CONSTRAINT [PK_tbl_TipoVenta] PRIMARY KEY CLUSTERED 
(
	[ID_intTipoVta] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Vendedor]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Vendedor](
	[ID_intVendedor] [int] IDENTITY(1,1) NOT NULL,
	[vchNomVend] [varchar](50) NULL,
	[ID_intComuna] [int] NULL,
 CONSTRAINT [PK_tbl_Vendedor] PRIMARY KEY CLUSTERED 
(
	[ID_intVendedor] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_Venta]    Script Date: 23-09-2019 18:16:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_Venta](
	[ID_intVenta] [int] IDENTITY(1,1) NOT NULL,
	[dtFechaVenta] [date] NULL,
	[ID_intVendedor] [int] NULL,
	[vchRut] [varchar](10) NULL,
	[ID_intTipoVta] [int] NULL,
 CONSTRAINT [PK_tbl_Venta] PRIMARY KEY CLUSTERED 
(
	[ID_intVenta] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[tbl_ciudad] ON 
GO
INSERT [dbo].[tbl_ciudad] ([ID_intCiudad], [vchNomCiu], [ID_intRegion]) VALUES (1, N'Santiago', 1)
GO
INSERT [dbo].[tbl_ciudad] ([ID_intCiudad], [vchNomCiu], [ID_intRegion]) VALUES (2, N'Viña', 6)
GO
INSERT [dbo].[tbl_ciudad] ([ID_intCiudad], [vchNomCiu], [ID_intRegion]) VALUES (3, N'Valparaiso', 6)
GO
INSERT [dbo].[tbl_ciudad] ([ID_intCiudad], [vchNomCiu], [ID_intRegion]) VALUES (4, N'Rancagua', 9)
GO
SET IDENTITY_INSERT [dbo].[tbl_ciudad] OFF
GO
INSERT [dbo].[tbl_cliente] ([vchRut], [vchNombre], [vchApePat], [vchApeMat], [ID_intComuna]) VALUES (N'100-1', N'GIOVANNI', N'HERNANDEZ', N'SALDIAS', NULL)
GO
INSERT [dbo].[tbl_cliente] ([vchRut], [vchNombre], [vchApePat], [vchApeMat], [ID_intComuna]) VALUES (N'1-7', N'Barbara', N'Sepulveda', N'Reinoso', NULL)
GO
INSERT [dbo].[tbl_cliente] ([vchRut], [vchNombre], [vchApePat], [vchApeMat], [ID_intComuna]) VALUES (N'1-8', N'Amalia', N'Garrido', N'Sepúlveda', NULL)
GO
INSERT [dbo].[tbl_cliente] ([vchRut], [vchNombre], [vchApePat], [vchApeMat], [ID_intComuna]) VALUES (N'1-9', N'Juan', N'Aristia', N'Chacón', NULL)
GO
SET IDENTITY_INSERT [dbo].[tbl_Comuna] ON 
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (1, N'Machali', 4)
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (2, N'Coltauco', 4)
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (3, N'Santiago', 1)
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (4, N'Las Condes', 1)
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (5, N'Providencia', 1)
GO
INSERT [dbo].[tbl_Comuna] ([ID_intComuna], [vchNomCom], [ID_intCiudad]) VALUES (6, N'La Florida', 1)
GO
SET IDENTITY_INSERT [dbo].[tbl_Comuna] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_DetalleVenta] ON 
GO
INSERT [dbo].[tbl_DetalleVenta] ([ID_intDetalle], [ID_intProducto], [ID_intVenta], [intCantidad]) VALUES (1, 1, 1, 10)
GO
INSERT [dbo].[tbl_DetalleVenta] ([ID_intDetalle], [ID_intProducto], [ID_intVenta], [intCantidad]) VALUES (2, 2, 1, 2)
GO
INSERT [dbo].[tbl_DetalleVenta] ([ID_intDetalle], [ID_intProducto], [ID_intVenta], [intCantidad]) VALUES (3, 3, 1, 20)
GO
INSERT [dbo].[tbl_DetalleVenta] ([ID_intDetalle], [ID_intProducto], [ID_intVenta], [intCantidad]) VALUES (4, 1, 2, 15)
GO
INSERT [dbo].[tbl_DetalleVenta] ([ID_intDetalle], [ID_intProducto], [ID_intVenta], [intCantidad]) VALUES (5, 2, 2, 5)
GO
SET IDENTITY_INSERT [dbo].[tbl_DetalleVenta] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Pais] ON 
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (1, N'Chile     ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (2, N'Colombia  ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (3, N'Venezuela ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (4, N'Argentina ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (5, N'Perú      ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (6, N'Bolivia   ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (7, N'EEUU      ')
GO
INSERT [dbo].[tbl_Pais] ([ID_intPais], [vchNomPais]) VALUES (8, N'Francia   ')
GO
SET IDENTITY_INSERT [dbo].[tbl_Pais] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Producto] ON 
GO
INSERT [dbo].[tbl_Producto] ([ID_intProducto], [vchNomProd], [intStock], [intPrecio]) VALUES (1, N'Lapices', 100, 1000)
GO
INSERT [dbo].[tbl_Producto] ([ID_intProducto], [vchNomProd], [intStock], [intPrecio]) VALUES (2, N'Goma de Borrar', 200, 500)
GO
INSERT [dbo].[tbl_Producto] ([ID_intProducto], [vchNomProd], [intStock], [intPrecio]) VALUES (3, N'Cuaderno Universitario', 20, 560)
GO
INSERT [dbo].[tbl_Producto] ([ID_intProducto], [vchNomProd], [intStock], [intPrecio]) VALUES (4, N'Block', 50, 2500)
GO
SET IDENTITY_INSERT [dbo].[tbl_Producto] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Region] ON 
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (1, N'RM', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (2, N'I Región', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (3, N'II Región', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (4, N'III Región', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (5, N'IV Región', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (6, N'V Región', 1)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (7, N'Tucuman', 4)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (8, N'Buenos Aires', 4)
GO
INSERT [dbo].[tbl_Region] ([ID_intRegion], [vchNomReg], [ID_intPais]) VALUES (9, N'VI Region', 1)
GO
SET IDENTITY_INSERT [dbo].[tbl_Region] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_TipoVenta] ON 
GO
INSERT [dbo].[tbl_TipoVenta] ([ID_intTipoVta], [vchNomTipoVta]) VALUES (1, N'Online')
GO
INSERT [dbo].[tbl_TipoVenta] ([ID_intTipoVta], [vchNomTipoVta]) VALUES (2, N'Presencial')
GO
SET IDENTITY_INSERT [dbo].[tbl_TipoVenta] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Vendedor] ON 
GO
INSERT [dbo].[tbl_Vendedor] ([ID_intVendedor], [vchNomVend], [ID_intComuna]) VALUES (1, N'Juan', 1)
GO
INSERT [dbo].[tbl_Vendedor] ([ID_intVendedor], [vchNomVend], [ID_intComuna]) VALUES (2, N'Jose', 1)
GO
INSERT [dbo].[tbl_Vendedor] ([ID_intVendedor], [vchNomVend], [ID_intComuna]) VALUES (3, N'Alonso', 2)
GO
INSERT [dbo].[tbl_Vendedor] ([ID_intVendedor], [vchNomVend], [ID_intComuna]) VALUES (4, N'Maria', 3)
GO
INSERT [dbo].[tbl_Vendedor] ([ID_intVendedor], [vchNomVend], [ID_intComuna]) VALUES (5, N'GIOVANNI', 4)
GO
SET IDENTITY_INSERT [dbo].[tbl_Vendedor] OFF
GO
SET IDENTITY_INSERT [dbo].[tbl_Venta] ON 
GO
INSERT [dbo].[tbl_Venta] ([ID_intVenta], [dtFechaVenta], [ID_intVendedor], [vchRut], [ID_intTipoVta]) VALUES (1, CAST(N'2018-12-12' AS Date), 1, N'1-9', 1)
GO
INSERT [dbo].[tbl_Venta] ([ID_intVenta], [dtFechaVenta], [ID_intVendedor], [vchRut], [ID_intTipoVta]) VALUES (2, CAST(N'2018-12-10' AS Date), 2, N'1-8', 2)
GO
SET IDENTITY_INSERT [dbo].[tbl_Venta] OFF
GO
ALTER TABLE [dbo].[tbl_ciudad]  WITH CHECK ADD  CONSTRAINT [FK_tbl_ciudad_tbl_Region] FOREIGN KEY([ID_intRegion])
REFERENCES [dbo].[tbl_Region] ([ID_intRegion])
GO
ALTER TABLE [dbo].[tbl_ciudad] CHECK CONSTRAINT [FK_tbl_ciudad_tbl_Region]
GO
ALTER TABLE [dbo].[tbl_cliente]  WITH CHECK ADD  CONSTRAINT [FK_tbl_cliente_tbl_Comuna] FOREIGN KEY([ID_intComuna])
REFERENCES [dbo].[tbl_Comuna] ([ID_intComuna])
GO
ALTER TABLE [dbo].[tbl_cliente] CHECK CONSTRAINT [FK_tbl_cliente_tbl_Comuna]
GO
ALTER TABLE [dbo].[tbl_Comuna]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Comuna_tbl_ciudad] FOREIGN KEY([ID_intCiudad])
REFERENCES [dbo].[tbl_ciudad] ([ID_intCiudad])
GO
ALTER TABLE [dbo].[tbl_Comuna] CHECK CONSTRAINT [FK_tbl_Comuna_tbl_ciudad]
GO
ALTER TABLE [dbo].[tbl_DetalleVenta]  WITH CHECK ADD  CONSTRAINT [FK_tbl_DetalleVenta_tbl_Producto] FOREIGN KEY([ID_intProducto])
REFERENCES [dbo].[tbl_Producto] ([ID_intProducto])
GO
ALTER TABLE [dbo].[tbl_DetalleVenta] CHECK CONSTRAINT [FK_tbl_DetalleVenta_tbl_Producto]
GO
ALTER TABLE [dbo].[tbl_DetalleVenta]  WITH CHECK ADD  CONSTRAINT [FK_tbl_DetalleVenta_tbl_Venta] FOREIGN KEY([ID_intVenta])
REFERENCES [dbo].[tbl_Venta] ([ID_intVenta])
GO
ALTER TABLE [dbo].[tbl_DetalleVenta] CHECK CONSTRAINT [FK_tbl_DetalleVenta_tbl_Venta]
GO
ALTER TABLE [dbo].[tbl_Region]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Region_tbl_Pais] FOREIGN KEY([ID_intPais])
REFERENCES [dbo].[tbl_Pais] ([ID_intPais])
GO
ALTER TABLE [dbo].[tbl_Region] CHECK CONSTRAINT [FK_tbl_Region_tbl_Pais]
GO
ALTER TABLE [dbo].[tbl_Vendedor]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Vendedor_tbl_Comuna] FOREIGN KEY([ID_intComuna])
REFERENCES [dbo].[tbl_Comuna] ([ID_intComuna])
GO
ALTER TABLE [dbo].[tbl_Vendedor] CHECK CONSTRAINT [FK_tbl_Vendedor_tbl_Comuna]
GO
ALTER TABLE [dbo].[tbl_Venta]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Venta_tbl_cliente] FOREIGN KEY([vchRut])
REFERENCES [dbo].[tbl_cliente] ([vchRut])
GO
ALTER TABLE [dbo].[tbl_Venta] CHECK CONSTRAINT [FK_tbl_Venta_tbl_cliente]
GO
ALTER TABLE [dbo].[tbl_Venta]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Venta_tbl_TipoVenta] FOREIGN KEY([ID_intTipoVta])
REFERENCES [dbo].[tbl_TipoVenta] ([ID_intTipoVta])
GO
ALTER TABLE [dbo].[tbl_Venta] CHECK CONSTRAINT [FK_tbl_Venta_tbl_TipoVenta]
GO
ALTER TABLE [dbo].[tbl_Venta]  WITH CHECK ADD  CONSTRAINT [FK_tbl_Venta_tbl_Vendedor] FOREIGN KEY([ID_intVendedor])
REFERENCES [dbo].[tbl_Vendedor] ([ID_intVendedor])
GO
ALTER TABLE [dbo].[tbl_Venta] CHECK CONSTRAINT [FK_tbl_Venta_tbl_Vendedor]
GO
