<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property bool $is_active
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Role[] $roles
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'is_active' => true,
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'roles' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    protected function _getFirstName($first_name){

        return $first_name;
    }
    protected function _getLastName($last_name){

        return $last_name;
    }
    protected function _getIsActive($is_active){

        return $is_active;
    }
    protected function _getEmail($email){

        return $email;
    }
    protected function _getRoles($roles){

        return $roles;
    }
    protected function _getPassword($password){

        return $password;
    }
    public function is_admin(){
        return strcasecmp($this->getRole(), 'Admin') === 0;
    }
    public function is_user(){
        return strcasecmp($this->getRole(), 'User') === 0;
    }

    public function getRole(){
        return $this->roles[0]->name;
    }
 

  /**
   * 
   * Mutators
   * =========
   * 
   */
  protected function _setFirstName($first_name){

      $this->first_name = $first_name;

      return $first_name;
  }

  protected function _setLastName($last_name){

    $this->last_name = $last_name;
    
    return $last_name;
}

protected function _setActive($is_active){

    $this->$is_active = $is_active;
    
    return $is_active;
}
protected function _setEmail($email){
    
    $this->email = $email;
    return $email;
}
protected function _setPassword($password){

    $this->password = password_hash($password,PASSWORD_BCRYPT);

    return $this->password;
}

}
