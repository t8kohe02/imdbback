/* Titlejen trimmaus */
UPDATE `titles` SET `primary_title`= TRIM(`primary_title`);
/* Genrejen trimmaus */
UPDATE `title_genres` SET `genre` = TRIM(`genre`);
/* Genreistä linebreakit pois */
UPDATE `title_genres` SET `genre` = REPLACE(`genre`, '\r', '');
/* Roolien trimmaus */
UPDATE `had_role` SET `role_` = TRIM(`role_`);
/* KAIKKI VIEWT JA PROCEDURE TÄYTYY AJAA TIETOKANTAAN 
ENNEN KUIN NETTISIVULTA VOI TEHDÄ KYSEISIÄ HAKUJA*/

/* View 10 suomalaisen elokuvan näyttämiseen */
CREATE VIEW suomalaisia AS 
SELECT title, genre, start_year
FROM titles INNER JOIN title_genres
ON titles.title_id = title_genres.title_id
INNER JOIN aliases 
ON titles.title_id = aliases.title_id
WHERE region = "FI"
LIMIT 10;

/* View 10 englantilaisen elokuvan näyttämiseen */
CREATE VIEW englantilaisia AS
SELECT title, genre, start_year
FROM titles INNER JOIN title_genres
ON titles.title_id = title_genres.title_id
INNER JOIN aliases
ON titles.title_id = aliases.title_id
WHERE region = "GB"
LIMIT 10;

/* View 10 ruotsalaisen elokuvan näyttämiseen */
CREATE VIEW ruotsalaisia AS
SELECT title, genre, start_year
FROM titles INNER JOIN title_genres
ON titles.title_id = title_genres.title_id
INNER JOIN aliases
ON titles.title_id = aliases.title_id
WHERE region = "SE"
LIMIT 10;

/* Procedure joka antaa titlejä ratingin perusteella*/
DELIMITER $$
CREATE PROCEDURE TitleByRating(
	IN ratingAmount FLOAT
)
	BEGIN
        SELECT DISTINCT title, average_rating
        FROM aliases INNER JOIN title_ratings
        ON aliases.title_id = title_ratings.title_id
        WHERE average_rating > ratingAmount
        ORDER BY average_rating
        LIMIT 10;
	END $$
DELIMITER ;