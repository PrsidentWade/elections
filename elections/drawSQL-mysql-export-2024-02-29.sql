CREATE TABLE `Bureau_Vote`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom_bureau_vote` VARCHAR(255) NOT NULL,
    `id_centre_vote` INT NOT NULL
);
CREATE TABLE `Centre_vote`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom_centre_vote` VARCHAR(255) NOT NULL,
    `nom_commune` VARCHAR(255) NOT NULL,
    `nom_region` VARCHAR(255) NOT NULL,
    `nom_departement` VARCHAR(255) NOT NULL
);
CREATE TABLE `Score`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_bureau_vote` INT NOT NULL,
    `id_candidat` INT NOT NULL,
    `score` VARCHAR(255) NOT NULL
);

CREATE TABLE `President_centre`(
    `id_utilisateur` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom_utilisateur` VARCHAR(255) NOT NULL,
    `email_utilisateur` VARCHAR(255) NOT NULL,
    `mot_de_passe` VARCHAR(255) NOT NULL
);
CREATE TABLE `Candidat`(
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `partie_politique` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `Score` ADD CONSTRAINT `score_id_bureau_vote_foreign` FOREIGN KEY(`id_bureau_vote`) REFERENCES `Bureau_vote`(`id`);
ALTER TABLE
    `Bureau_vote` ADD CONSTRAINT `bureau_vote_id_centre_vote_foreign` FOREIGN KEY(`id_centre_vote`) REFERENCES `Centre_vote`(`id`);
ALTER TABLE
    `Score` ADD CONSTRAINT `score_id_candidat_foreign` FOREIGN KEY(`id_candidat`) REFERENCES `Candidat`(`id`);