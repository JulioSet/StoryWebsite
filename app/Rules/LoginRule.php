<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LoginRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    // BUAT VARIABLE BARU UNTUK TAMPUNG DATA DARI LUAR
    public $listUser;
    public $password;

    public function __construct($data, $pass)
    {
        // Taruh data dari luar ke class
        $this->listUser = $data;
        $this->password = $pass;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->listUser as $key => $u) {
            if($u->username == $value && $this->password == $u->password)
                return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'GAGAL LOGIN!';
    }
}
