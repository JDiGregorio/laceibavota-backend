<?php

namespace App\GraphQL\Resolvers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Voter;

class ListVoterResolver
{
    public function __invoke($root, array $args)
    {
		$page = $args['page'] ?? 1;
        $perPage = $args['first'];
        $search = $args['search'] ?? '';

		$user = Auth::user();

		if (!$user) {
			abort(403, 'Usuario no autenticado.');
		}

		/**
		 * Según el rol del usuario listará la información.
		 * Super Administrador -> verá la información de todos.
		 * Coordinador -> verá la información de los movilizadores relacionados a el.
		 * Mobilizador -> verá la información que ha ingresado.
		 */

		$items = Voter::search($search)
			->query(function ($query) use ($user) {
				$query->where('mobilizer_id', $user->id);
			})
			->orderBy('id', 'asc')
			->get();

		$currentItems = $items->slice(($page - 1) * $perPage, $perPage)->values();

		$paginator = new LengthAwarePaginator(
            $currentItems,
            $items->count(),
            $perPage,
            $page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return $paginator;
    }
}