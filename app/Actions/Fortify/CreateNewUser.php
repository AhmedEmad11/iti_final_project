<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'=> ['required', 'string', Rule::in(['admin', 'student'])],
            'password' => $this->passwordRules(),
        ])->validate();

        $studentCount = User::where('role', 'student')->count();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => Hash::make($input['password']),
        ]);
        
        $role = $input['role'];
        if ($role == 'student')
        {
            $user->student_id = $studentCount + 1;
            $user->save();
        }
        return $user;
    }
}
