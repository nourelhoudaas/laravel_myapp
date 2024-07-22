<?php

    namespace App\Actions\Fortify;

    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use Laravel\Fortify\Contracts\UpdatesUserPasswords;

    class UpdateUserPassword implements UpdatesUserPasswords
    {
        use PasswordValidationRules;

        /**
         * Validate and update the user's password.
         *
         * @param  array<string, string>  $input
         */
        public function update(User $user, array $input): void
        {
            Validator::make($input, [
                'current_password' => ['required', 'string', 'current_password:web'],
                'password' => $this->passwordRules(),
            ], [
                'current_password.current_password' => __('The provided password does not match your current password.'),
            ])->validateWithBag('updatePassword');
            
     // Verify the current password
     if (!Hash::check($input['current_password'], $user->password)) {
        // Handle invalid current password
        throw new \Exception('Le mot de passe actuel est incorrect.');

            $user->forceFill([
                'password_changed_at' => now(), 
                'nv_password' => Hash::make($input['password']),
            ])->save();
        //  auth()->logout();
    }
    }
}
