<?php
// Database functions for Film Review Website
// 1. Get all the reviews
function totalReviews($pdo)
{
    $query = $pdo->query('SELECT COUNT(*) FROM review');
    $row = $query->fetch();
    return $row[0];
}
// 2. Get all the films, reviewers, and genres for dropdowns
function getFilms($pdo)
{
    $sql = 'SELECT * FROM film';
    $query = $pdo->query($sql);
    return $query->fetchAll();
}
// 3. Get all reviewers except Admin for dropdown
function getReviewers($pdo)
{
    $sql = "SELECT * FROM reviewer WHERE name != 'Admin'";
    $query = $pdo->query($sql);
    return $query->fetchAll();
}
// 4. Get all genres for dropdown
function getGenres($pdo)
{
    $genres = $pdo->query('SELECT id, name FROM genre');
    return $genres;
}
// 5. Get all reviews with reviewer name, film title, and genres
function getReviews($pdo)
{
    $sql = 'SELECT r.id AS review_id, r.reviewtext, r.rating, r.reviewdate, r.poster, 
                   u.name AS reviewer, f.title AS film_title, GROUP_CONCAT(g.name SEPARATOR ", ") AS genres 
            FROM review r 
            JOIN reviewer u ON r.reviewerid = u.id 
            LEFT JOIN reviewgenre rg ON r.id = rg.reviewid 
            LEFT JOIN genre g ON rg.genreid = g.id 
            LEFT JOIN film f ON r.filmid = f.id 
            GROUP BY r.id
            ORDER BY r.reviewdate DESC';

    return $pdo->query($sql);
}
// 6. Insert new review and return the new review ID
function insertReview($pdo, $reviewtext, $rating, $filmid, $reviewerid, $posterName)
{
    $sql = 'INSERT INTO review (reviewtext, rating, reviewdate, filmid, reviewerid, poster) 
            VALUES (:reviewtext, :rating, CURDATE(), :filmid, :reviewerid, :poster)';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':reviewtext' => $reviewtext,
        ':rating'     => $rating,
        ':filmid'     => $filmid,
        ':reviewerid' => $reviewerid,
        ':poster'     => $posterName
    ]);

    return $pdo->lastInsertId();
}
// 7. Insert review-genre relationships
function insertReviewGenre($pdo, $reviewid, $genreid)
{
    $sql = 'INSERT INTO reviewgenre SET
          reviewid = :reviewid,
          genreid = :genreid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':reviewid' => $reviewid,
        ':genreid' => $genreid
    ]);
}
// 8. Get movies for home page (id, title, poster)
function getHomeMovies($pdo)
{
    $sql = 'SELECT id, title, poster FROM film';

    return $pdo->query($sql);
}
// Processing functions for contact form
// 1. Insert new contact message
function insertContact($pdo, $name, $email, $message)
{
    $sql = "INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ]);
}
// Processing functions for review list

//  Get a specific review (for editing)
function getReviewById($pdo, $id)
{
    $sql = 'SELECT * FROM review WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

// Updated review
function updateReview($pdo, $id, $reviewtext, $rating, $filmid, $reviewerid, $poster = null)
{
    if ($poster) {
        $sql = 'UPDATE review SET reviewtext = :reviewtext, rating = :rating, filmid = :filmid, reviewerid = :reviewerid, poster = :poster WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':reviewtext' => $reviewtext,
            ':rating' => $rating,
            ':filmid' => $filmid,
            ':reviewerid' => $reviewerid,
            ':poster' => $poster,
            ':id' => $id
        ]);
    } else {
        $sql = 'UPDATE review SET reviewtext = :reviewtext, rating = :rating, filmid = :filmid, reviewerid = :reviewerid WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':reviewtext' => $reviewtext,
            ':rating' => $rating,
            ':filmid' => $filmid,
            ':reviewerid' => $reviewerid,
            ':id' => $id
        ]);
    }
}

function getReviewGenreIds($pdo, $reviewid)
{
    $sql = 'SELECT genreid FROM reviewgenre WHERE reviewid = :reviewid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':reviewid' => $reviewid]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN); 
}

function deleteReviewGenres($pdo, $reviewid)
{
    $sql = 'DELETE FROM reviewgenre WHERE reviewid = :reviewid';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':reviewid' => $reviewid]);
}

// Delete review
function deleteReview($pdo, $id)
{
    $sql = 'DELETE FROM review WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

// Processing functions for film list 

// 1. Add new film
function insertFilm($pdo, $title, $description, $year, $poster)
{
    // Thêm cột description vào câu lệnh SQL
    $query = 'INSERT INTO film (title, description, year, poster) 
              VALUES (:title, :description, :year, :poster)';

    $parameters = [
        ':title' => $title,
        ':description' => $description,
        ':year' => $year,
        ':poster' => $poster
    ];

    $stmt = $pdo->prepare($query);
    $stmt->execute($parameters);
}

// 2. Get a specific film (for editing)
function getFilmById($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM film WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

// 3. Update film
function updateFilm($pdo, $id, $title, $description, $year, $poster = null)
{
    if ($poster) {
        $sql = 'UPDATE film SET title = :title, description = :description, 
                       year = :year, poster = :poster WHERE id = :id';
        $parameters = [
            'title' => $title,
            'description' => $description,
            'year' => $year,
            'poster' => $poster,
            'id' => $id
        ];
    } else {
        $sql = 'UPDATE film SET title = :title, description = :description, 
                       year = :year WHERE id = :id';
        $parameters = [
            'title' => $title,
            'description' => $description,
            'year' => $year,
            'id' => $id
        ];
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);
}

// 4. Delete film
function deleteFilm($pdo, $id)
{
    $sql = 'DELETE FROM film WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

// Processing functions for reviewer list

// 1. Add new reviewer
function insertReviewer($pdo, $name, $email)
{
    $sql = 'INSERT INTO reviewer (name, email) VALUES (:name, :email)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email
    ]);
}

// 2. Get a specific reviewer (for editing)
function getReviewerById($pdo, $id)
{
    $sql = 'SELECT * FROM reviewer WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}


// 3. Update reviewer
function updateReviewer($pdo, $id, $name, $email)
{
    $sql = 'UPDATE reviewer SET name = :name, email = :email WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':id' => $id
    ]);
}

// 4. Delete reviewer
function deleteReviewer($pdo, $id)
{
    $sql = 'DELETE FROM reviewer WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

// Processing functions for contact list

// 1. Get all messages
function getContacts($pdo)
{
    $sql = 'SELECT * FROM contact ORDER BY id DESC';
    $query = $pdo->query($sql);
    return $query->fetchAll();
}
// 2. Get a specific message to view and reply to
function getContactById($pdo, $id)
{
    $sql = 'SELECT * FROM contact WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch();
}

// 3. Save the reply content to the database
function updateContactReply($pdo, $id, $reply)
{
    $sql = 'UPDATE contact SET reply = :reply WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':reply' => $reply,
        ':id' => $id
    ]);
}
// 4. Delete message
function deleteContact($pdo, $id)
{
    $sql = 'DELETE FROM contact WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
}

// Get list of messages and replies by user email
function getUserMessages($pdo, $email)
{
    $sql = 'SELECT * FROM contact WHERE email = :email ORDER BY id DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    return $stmt->fetchAll();
}
// Get reviews for a specific film by film ID
function getReviewsByFilmId($pdo, $filmid)
{
    $sql = 'SELECT r.id AS review_id, r.reviewtext, r.rating, r.reviewdate, r.poster, 
                   u.name AS reviewer_name, f.title AS film_title, 
                   GROUP_CONCAT(g.name SEPARATOR ", ") AS genres 
            FROM review r 
            JOIN reviewer u ON r.reviewerid = u.id 
            JOIN film f ON r.filmid = f.id 
            LEFT JOIN reviewgenre rg ON r.id = rg.reviewid 
            LEFT JOIN genre g ON rg.genreid = g.id 
            WHERE r.filmid = :filmid
            GROUP BY r.id 
            ORDER BY r.reviewdate DESC';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['filmid' => $filmid]);
    return $stmt->fetchAll();
}
