USE [master]
GO
/****** Object:  Database [BecasBeneficios]    Script Date: 13-12-2020 21:30:55 ******/
CREATE DATABASE [BecasBeneficios]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'BecasBeneficios', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\BecasBeneficios.mdf' , SIZE = 73728KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'BecasBeneficios_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\BecasBeneficios_log.ldf' , SIZE = 270336KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [BecasBeneficios] SET COMPATIBILITY_LEVEL = 140
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [BecasBeneficios].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [BecasBeneficios] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [BecasBeneficios] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [BecasBeneficios] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [BecasBeneficios] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [BecasBeneficios] SET ARITHABORT OFF 
GO
ALTER DATABASE [BecasBeneficios] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [BecasBeneficios] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [BecasBeneficios] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [BecasBeneficios] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [BecasBeneficios] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [BecasBeneficios] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [BecasBeneficios] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [BecasBeneficios] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [BecasBeneficios] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [BecasBeneficios] SET  DISABLE_BROKER 
GO
ALTER DATABASE [BecasBeneficios] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [BecasBeneficios] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [BecasBeneficios] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [BecasBeneficios] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [BecasBeneficios] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [BecasBeneficios] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [BecasBeneficios] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [BecasBeneficios] SET RECOVERY FULL 
GO
ALTER DATABASE [BecasBeneficios] SET  MULTI_USER 
GO
ALTER DATABASE [BecasBeneficios] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [BecasBeneficios] SET DB_CHAINING OFF 
GO
ALTER DATABASE [BecasBeneficios] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [BecasBeneficios] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [BecasBeneficios] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [BecasBeneficios] SET QUERY_STORE = OFF
GO
USE [BecasBeneficios]
GO
/****** Object:  Table [dbo].[tbl_asistente]    Script Date: 13-12-2020 21:30:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_asistente](
	[rut_asistente] [varchar](15) NOT NULL,
	[nombre_asistente] [varchar](255) NULL,
	[apellido_asistente] [varchar](255) NULL,
	[mail_asistente] [varchar](255) NULL,
	[clave_asistente] [varchar](255) NULL,
	[estado] [int] NULL,
	[tipo] [int] NULL,
	[fecha_agregado] [date] NULL,
 CONSTRAINT [PK_tbl_asistente] PRIMARY KEY CLUSTERED 
(
	[rut_asistente] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_log]    Script Date: 13-12-2020 21:30:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_log](
	[id_log] [int] IDENTITY(1,1) NOT NULL,
	[rut_asistente] [varchar](15) NULL,
	[asistente] [varchar](max) NULL,
	[accion] [varchar](max) NULL,
	[fecha] [datetime] NULL,
 CONSTRAINT [PK_tbl_log] PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tbl_tipoAsistente]    Script Date: 13-12-2020 21:30:56 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tbl_tipoAsistente](
	[id_tipo] [int] NOT NULL,
	[nombre_tipo] [varchar](max) NULL,
 CONSTRAINT [PK_tbl_tipoAsistente] PRIMARY KEY CLUSTERED 
(
	[id_tipo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
INSERT [dbo].[tbl_asistente] ([rut_asistente], [nombre_asistente], [apellido_asistente], [mail_asistente], [clave_asistente], [estado], [tipo], [fecha_agregado]) VALUES (N'00.000.000-0', N'ADMIN', N'UFE', N'', N'$2y$10$MNb1O2M/LvMQMO6HOn.Rau53awrLkpl/BDeNnh0/eU5pjZB36GqeC', 0, 2, CAST(N'2019-10-16' AS Date))
INSERT [dbo].[tbl_asistente] ([rut_asistente], [nombre_asistente], [apellido_asistente], [mail_asistente], [clave_asistente], [estado], [tipo], [fecha_agregado]) VALUES (N'13.609.233-2', N'Alexina ', N'TriviÃ±os Buchner', N'', N'$2y$10$lZ/5r6vglBNUAWpfUPuMieOIXkqoA4qk0UUf1y4S6cCI/W7Q2xeSu', 0, 2, CAST(N'2019-12-03' AS Date))
INSERT [dbo].[tbl_asistente] ([rut_asistente], [nombre_asistente], [apellido_asistente], [mail_asistente], [clave_asistente], [estado], [tipo], [fecha_agregado]) VALUES (N'16.088.221-2', N'Elizabeth', N'Correa LÃ³pez', N'', N'$2y$10$KbRtryYd4Dokn3KG7DTPl.c2IDXD429z4v.iLePgHL.kp5S0JQOIO', 0, 1, CAST(N'2019-12-03' AS Date))
INSERT [dbo].[tbl_asistente] ([rut_asistente], [nombre_asistente], [apellido_asistente], [mail_asistente], [clave_asistente], [estado], [tipo], [fecha_agregado]) VALUES (N'16.276.338-5', N'Ximena', N'Blasco JimÃ©nez', N'', N'$2y$10$GtImGkNWkrVewHD0nwcGZe6VSNyqgYchKcO71zcoX65fO5edsPARu', 0, 1, CAST(N'2019-12-03' AS Date))
INSERT [dbo].[tbl_asistente] ([rut_asistente], [nombre_asistente], [apellido_asistente], [mail_asistente], [clave_asistente], [estado], [tipo], [fecha_agregado]) VALUES (N'19.562.183-7', N'lliz', N'beth', N'lalfaro@ciisa.cl', N'$2y$10$Z.kkz.eLYf48GzEp5NgMI.End2Seh7S.msvli83KTcF8Uf3O8RpjS', 1, 2, CAST(N'2020-12-12' AS Date))
SET IDENTITY_INSERT [dbo].[tbl_log] ON 

INSERT [dbo].[tbl_log] ([id_log], [rut_asistente], [asistente], [accion], [fecha]) VALUES (1041, N'19.562.183-7', N'lliz beth', N'Cierra session', CAST(N'2020-12-13T21:27:37.000' AS DateTime))
INSERT [dbo].[tbl_log] ([id_log], [rut_asistente], [asistente], [accion], [fecha]) VALUES (1042, N'19.562.183-7', N'lliz beth', N'Cierra session', CAST(N'2020-12-13T21:27:37.000' AS DateTime))
INSERT [dbo].[tbl_log] ([id_log], [rut_asistente], [asistente], [accion], [fecha]) VALUES (1043, N'19.562.183-7', N'lliz beth', N'Inicia session', CAST(N'2020-12-13T21:27:56.000' AS DateTime))
SET IDENTITY_INSERT [dbo].[tbl_log] OFF
INSERT [dbo].[tbl_tipoAsistente] ([id_tipo], [nombre_tipo]) VALUES (1, N'Asistente')
INSERT [dbo].[tbl_tipoAsistente] ([id_tipo], [nombre_tipo]) VALUES (2, N'Administrador')
ALTER TABLE [dbo].[tbl_asistente]  WITH CHECK ADD  CONSTRAINT [FK_tbl_asistente_tbl_tipoAsistente] FOREIGN KEY([tipo])
REFERENCES [dbo].[tbl_tipoAsistente] ([id_tipo])
GO
ALTER TABLE [dbo].[tbl_asistente] CHECK CONSTRAINT [FK_tbl_asistente_tbl_tipoAsistente]
GO
USE [master]
GO
ALTER DATABASE [BecasBeneficios] SET  READ_WRITE 
GO
