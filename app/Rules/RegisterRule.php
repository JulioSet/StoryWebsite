<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RegisterRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    // BUAT VARIABLE BARU UNTUK TAMPUNG DATA DARI LUAR
    public $listUser;
    public function __construct($data)
    {
        // Taruh data dari luar ke class
        $this->listUser = $data;
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
            if($u->username == $value)
                return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'USERNAME HARUS UNIK!';
    }
}
