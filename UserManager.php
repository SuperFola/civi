<?php
class UserManager {
    private $users;
    private $directory;
    private $filename;

    public function __construct() {
        $this->users = array();
        $this->directory = __DIR__ . '/db';
        $this->filename = 'users';

        $filepath = $this->directory . '/' . $this->filename;

        if (!is_dir($this->directory)) {
            mkdir($this->directory);
        }
        if (!is_file($filepath)) {
            $admin = new User();
            $admin->handlePostRequest('ADMIN', 'admin', 'admin@domain.com', 'ADMINISTRATEUR');
            $admin->setActivated(true);

            $this->addUser($admin);

            $this->persistUsers();
        }

        $this->users = $this->getFile($filepath);
    }


    /**
     * Permet de récupérer un utilisateur par son id
     *
     * @param $id
     *
     * @return User|null
     */
    public function findUser($id) {
        if (isset($this->users[intval($id)])) {
            return $this->users[intval($id)];
        }

        return null;
    }

    /**
     * Permet de récupérer un utilisateur par son pseudo
     *
     * @param $pseudo
     *
     * @return User|null
     */
    public function findUserByPseudo($pseudo) {
        foreach ($this->users as $user) {
            if ($user->getPseudo() == $pseudo) {
                return $user;
            }
        }

        return null;
    }

    public function findAll() {
        return $this->users;
    }

    /**
     * Permet d'ajouter un utilisateur à l'array $users
     *
     * @param User $user
     */
    public function addUser(User $user) {
        $user->setId(count($this->users));
        $this->users[] = $user;
        return $this;
    }

    /**
     * Permet de modifier un utilisateur de l'array $users
     *
     * @param User $user
     */
    public function editUser(User $user) {
        $this->users[$user->getId()] = $user;
        return $this;
    }

    /**
     * Permet de supprimer un utilisateur de l'array $users
     *
     * @param User $user
     *
     * @throws Exception
     */
    public function removeUser(User $user) {
        if ($user->isRoot()) {
            throw new Exception('Impossible de supprimer l\'utilisateur "' . $user->getPseudo() . '", ce dernier etant défini comme "root"');
        }
        unset($this->users[$user->getId()]);
        return $this;
    }

    /**
     * Retourne de récupérer l'array $users
     *
     * @return array
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * Permet de créer le fichier stockant l'array $users
     *
     * @throws Exception
     */
    private function persistUsers() {
        $filepath = $this->directory . '/' . $this->filename;

        if (is_file($filepath)) {
            throw new Exception('Le fichier "' . $filepath . '" existe déjà...');
        }

        $this->saveFile($filepath, serialize($this->users));
    }

    /**
     * Permet d'enregister dans le fichier l'array $users
     */
    public function updateUsers() {
        $filepath = $this->directory . '/' . $this->filename;

        if (!is_file($filepath)) {
            $this->persistUsers();
            return;
        }

        $this->saveFile($filepath, serialize($this->users));
        return $this;
    }

    /**
     * Permet de supprimer le fichier stockant les utilisateurs
     *
     * @throws Exception
     */
    private function deleteUsers() {
        $filepath = $this->directory . '/' . $this->filename;

        if (!is_file($filepath)) {
            throw new Exception('Le fichier "' . $filepath . '" n\'existe pas...');
        }

        unlink($filepath);
    }

    /**
     * Ecrit dans le fichier spécifié par $filepath
     *
     * @param $filepath
     * @param $string
     */
    private function saveFile($filepath, $string) {
        $file = fopen($filepath, 'w+');
        fwrite($file, $string);
        fclose($file);
    }

    /**
     * Renvoie le contenu d'un fichier sous forme d'array
     *
     * @param $filepath
     * @return array
     */
    private function getFile($filepath) {
        return unserialize(file_get_contents($filepath));
    }
}

class User {
    protected $id;
    protected $pseudo;
    protected $email;
    protected $cryptedPassword;
    protected $salt;
    protected $role;

    protected $timestampCreation;
    protected $lastLogin;

    protected $root;

    protected $key;
    protected $activated;

    protected $bio;  // string
    protected $contenu_sup;  // string
    protected $yearofbirth; // int
    protected $competences;  // array key => value ; ajout de key possible par l'user ; value : int

    // LIFO, stacked from bottom, displayed reverse order
    protected $messages;  // array timestamp => array (title => ... ; from => ... ; content (markdown) => ...)
    protected $last_message_read;  // count from top (0)

    public function __construct() {
        $this->timestampCreation = time();
        $this->lastLogin = time();
        $this->root = false;
        $this->key = "";
        $this->activated = false;
        $this->messages = array();
        $this->last_message_read = 0;
    }

    public function getCompactData() {
        $content = $this->pseudo . "\n" .
            $this->email . "\n" .
            (intval(date('Y')) - $this->yearofbirth) . " ans\n" .
            $this->bio . "\n" .
            $this->contenu_sup . "\n";

        foreach ($this->competences as $key => $value) {
            $content .= $key . "=" . $value . "\n";
        }

        return $content;
    }

    public function activate($key) {
        if ($this->key == $key)
            $this->activated = true;
        return $this->activated;
    }

    /**
     * Remplit un objet User à partir de la requête
     *
     * @return User
     */
    public function handlePostRequest($pseudo, $password, $email, $role) {
        $this->pseudo = htmlentities($pseudo);
        $this->email = htmlentities($email);
        if ($password != '') {
            $this->salt = $this->generateSalt();
            $this->cryptedPassword = sha1($this->salt . $password);
        }
        $this->role = $role;
        if ($pseudo == 'ADMIN')
            $this->activated = true;
        return $this;
    }

    public function setActivated($val=true) {
        $this->activated = $val;
        return $this;
    }

    public function getActivated() {
        return $this->activated;
    }

    /**
     * Retourne une array composé d'un boolean de validaté et d'une array des toutes les erreurs rencontrées
     *
     * @return array
     */
    public function validate() {
        $validation = array('valid' => true, 'errors' => array());
        if ($this->pseudo == '') {
            $validation['valid'] = false;
            $validation['errors']['user_pseudo'] = 'Votre pseudo ne peut être vide';
        }
        if ($this->email == '') {
            $validation['valid'] = false;
            $validation['errors']['user_email'] = 'Vous devez spécifier votre email';
        }
        if ($this->cryptedPassword == sha1($this->salt)) {
            $validation['valid'] = false;
            $validation['errors']['user_password'] = 'Vos devez spécifier un mot de passe';
        }
        return $validation;
    }

    /**
     * Permet de générer une valeur aléatoire pour le cryptage du mot de passe
     *
     * @return string
     */
    private function generateSalt() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $salt = '';
        for ($i = 0; $i < 7; $i++) {
            $salt .= $characters[rand(0, $charactersLength - 1)];
        }
        return $salt;
    }

    /**
     * Permet à partir du mot de passe donné (en clair) de valider le login d'un utilisateur
     *
     * @param $password
     *
     * @return bool
     */
    public function checkLogin($password) {
        if (sha1($this->salt . $password) == $this->cryptedPassword && $this->activated) {
            return true;
        }
        return false;
    }

    /**
     * Méthode rapide pour verifier le role d'un utilisateur
     *
     * @param $role
     *
     * @return bool
     */
    public function is($role) {
        return $this->role == $role;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return User
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setKey($key) {
        $this->key = $key;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo() {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     *
     * @return User
     */
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCryptedPassword() {
        return $this->cryptedPassword;
    }

    /**
     * @param mixed $cryptedPassword
     *
     * @return User
     */
    public function setCryptedPassword($cryptedPassword) {
        $this->cryptedPassword = $cryptedPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * @return mixed
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @param mixed $role
     *
     * @return User
     */
    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimestampCreation() {
        return $this->timestampCreation;
    }

    /**
     * @return mixed
     */
    public function getLastLogin() {
        return $this->getDisplayableDate($this->lastLogin);
    }

    public function getDisplayableDate($date_) {
        $diff = time() - $date_;
        if ($diff < 120) {
            return 'à l\'instant';
        }
        if ($diff < 3600) {
            return 'Il y a '. date('i', $diff) . ' minutes';
        } elseif ($diff < 86400) {
            if (intval(date('G', $diff)) > 1) {
                return 'Il y a '. date('G', $diff) . ' heures';
            } else {
                return 'Il y a '. date('G', $diff) . ' heure';
            }
        } elseif ($diff < 172800) {
            return 'Hier à '. date('H', $this->timestampCreation) . 'h';
        } else {
            if (intval(date('Y')) != intval(date('Y', $this->timestampCreation))) {
                return date('j', $this->timestampCreation) . ' ' . date('F', $this->timestampCreation) . ' ' . date('Y', $this->timestampCreation) . ', ' . date('H', $this->timestampCreation) . 'h' . date('i', $this->timestampCreation);
            } else {
                return date('j', $this->timestampCreation) . ' ' . date('F', $this->timestampCreation) . ', ' . date('H', $this->timestampCreation) . 'h' . date('i', $this->timestampCreation);
            }
        }
    }

    /**
     * @param mixed $lastLogin
     *
     * @return User
     */
    public function setLastLogin($lastLogin) {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRoot() {
        return $this->root;
    }

    /**
     * @param boolean $root
     */
    public function setRoot($root) {
        $this->root = $root;
        return $this;
    }

    public function setBio($bio) {
        $this->bio = $bio;
        return $this;
    }

    public function getBio() {
        if (isset($this->bio))
            return $this->bio;
        return "";
    }

    public function getContenuSup() {
        if (isset($this->contenu_sup))
            return $this->contenu_sup;
        return "";
    }

    public function setContenuSup($val) {
        $this->contenu_sup = $val;
        return $this;
    }

    public function getAge() {
        if (isset($this->yearofbirth))
            return intval(date('Y')) - $this->yearofbirth;
        return 0;
    }

    public function setAge($age) {
        $this->yearofbirth = intval(date('Y')) - $age;
        return $this;
    }

    public function getYearOfBirth() {
        return $this->yearofbirth;
    }

    public function setYearOfBirth($yob) {
        $this->yearofbirth = $yob;
        return $this;
    }

    public function getCompetences() {
        if (isset($this->competences))
            return $this->competences;
        return array("empty" => true);
    }

    public function setCompetences($competences) {
        $this->competences = $competences;
        return $this;
    }

    public function getUnreadMessages() {
        return count($this->messages) - $this->last_message_read;
    }

    // Meant to be used by another User
    // LIFO, stacked from bottom, displayed reverse order
    // $messages  // array id => array (timestamp => ... ; title => ... ; from => ... ; content (markdown) => ...)
    // $last_message_read  // count from top (0)
    public function sendMessage($timestamp, $title, $from, $content) {
        $this->messages[] = array(
            "timestamp" => $timestamp,
            "title" => $title,
            "from" => $from,
            "content" => $content
        );
        return $this;
    }

    // Meant to be used by the User
    public function markMessageAsRead($message_index) {
        if ($message_index < count($this->messages)) {
            $temp = $this->messages[$this->last_message_read++];
            $this->messages[$this->last_message_read] = $messages[$message_index];
            $this->messages[$message_index] = $temp;
        }
        return $this;
    }

    // Meant to be used by the User
    public function deleteMessage($message_index) {
        if ($message_index < count($this->messages)) {
            array_splice($this->messages, $message_index, 1);
        }
        return $this;
    }

    // Meant to be used by the User
    public function getArrayOfMessages() {
        return $this->messages;
    }

    // Meant to be used by the User
    public function formatMessageToMarkdown($message_index) {
        if ($message_index < count($this->messages)) {
            $msg = $this->messages[$message_index];
            $f = "Message de " . $msg["from"]->getPseudo() . " (" . $msg["from"]->getEmail() . ") ";
            $f .= $this->getDisplayableDate($msg["timestamp"]);
            $f .= "\n### " . $msg["title"] . "\n" . $msg["content"] . "\n";
            return $f;
        }
        return '## Erreur\nImpossible formater le message, celui-ci est introuvable';
    }
}
