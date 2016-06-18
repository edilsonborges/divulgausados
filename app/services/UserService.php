<?php

class UserService extends BaseService
{

    public function login($email, $password)
    {
        $user = User::where('email', 'like', $email)->first();
        if ($user && !empty($password) && Hash::check($password, $user->password)) {
            Auth::login($user);
            return true;
        }
        return false;
    }

    public function save($attributes)
    {
        return $this->persist($attributes, function ($validated) {
            $user = new User();
            $this->setAttributeIfExists($user, $validated, 'name');
            $this->setAttributeIfExists($user, $validated, 'email');
            $user->password = Hash::make($validated['password']);
            $user->save();
            $this->addSuccessMessage('Sua conta foi criada com sucesso!');
            return $user;
        });
    }

    public function update($id, $attributes)
    {
        $this->persist($attributes, function ($validated) use ($id) {
            $user = User::find($id);
            $this->setAttributeIfExists($user, $validated, 'name');
            $user->save();
            $this->addSuccessMessage('Dados do usuário atualizados com sucesso!');
        });
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
            $this->addSuccessMessage('Sua conta foi excluída com sucesso!');
        }
    }

    public function findOne($id)
    {
        return User::find($id);
    }

    public function findAll()
    {
        if ($this->hasPagination()) {
            return User::orderBy('name')->filter()->paginate($this->getPageSize());
        } else {
            return User::orderBy('name')->filter()->get();
        }
    }

    protected function persist($attributes, $callback)
    {
        if (User::validate($attributes)) {
            return $callback($attributes);
        } else {
            $this->addWarningMessage(User::getValidationMessages());
        }
        return null;
    }

}