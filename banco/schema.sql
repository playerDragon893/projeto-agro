-- plantadb.categoria definição

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.plantas definição

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_comum` varchar(30) NOT NULL,
  `nome_cientifico` varchar(50) NOT NULL,
  `descricao` varchar(90) NOT NULL,
  `horas_sol_dia` int(11) DEFAULT NULL,
  `tipo_solo` varchar(20) DEFAULT NULL,
  `ph_solo_ideal` varchar(20) DEFAULT NULL,
  `clima_adequado` varchar(30) DEFAULT NULL,
  `temperatura_min` int(11) NOT NULL,
  `temperatura_max` int(11) NOT NULL,
  `umidade_ideal` varchar(30) DEFAULT NULL,
  `regiao_ideal` varchar(30) DEFAULT NULL,
  `tipo_adubo` varchar(30) DEFAULT NULL,
  `frequencia_adubacao` varchar(30) DEFAULT NULL,
  `espacamento_cm` varchar(10) DEFAULT NULL,
  `profundidade_plantio_cm` int(11) DEFAULT NULL,
  `pragas_comuns` text DEFAULT NULL,
  `doencas_comuns` text DEFAULT NULL,
  `imagem_url` varchar(100) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `plantas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.fase_planta definição

CREATE TABLE `fase_planta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem` int(11) NOT NULL,
  `nome_fase` varchar(25) NOT NULL,
  `descricao` text DEFAULT NULL,
  `duracao_dias` int(11) NOT NULL,
  `agua_ml_dia` int(11) DEFAULT NULL,
  `frequencia_rega_dias` int(11) DEFAULT NULL,
  `dica_cuidado` text DEFAULT NULL,
  `imagem_url` varchar(90) DEFAULT NULL,
  `id_planta` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_planta` (`id_planta`),
  CONSTRAINT `fase_planta_ibfk_1` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.usuarios definição

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `criacao_conta` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_acesso` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.admin definição

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.progresso_usuario definição

CREATE TABLE `progresso_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_planta` int(11) NOT NULL,
  `data_inicio_cultivo` date NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('ativo','concluido','cancelado') DEFAULT 'ativo',
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_planta` (`id_planta`),
  CONSTRAINT `progresso_usuario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `progresso_usuario_ibfk_2` FOREIGN KEY (`id_planta`) REFERENCES `plantas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- plantadb.historico_registros definição

CREATE TABLE `historico_registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_progresso_usuario` int(11) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_acao` enum('poda','rega','adubo','observacao') NOT NULL,
  `observacao` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_progresso_usuario` (`id_progresso_usuario`),
  CONSTRAINT `historico_registros_ibfk_1` FOREIGN KEY (`id_progresso_usuario`) REFERENCES `progresso_usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;