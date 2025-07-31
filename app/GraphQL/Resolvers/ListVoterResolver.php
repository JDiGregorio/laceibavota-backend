<?php

namespace App\GraphQL\Resolvers;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Voter;

class ListVoterResolver
{
    public function __invoke($root, array $args)
    {
		$page = $args['page'] ?? 1;
        $perPage = $args['first'];
        $search = $args['search'] ?? '';

		$items = Voter::search($search)
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