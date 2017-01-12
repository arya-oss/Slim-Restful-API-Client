<?php
namespace App\Controllers;

use App\Models\User as User;

class UserController {

	public function getAll($request, $response) {
    return $response->withJson(User::all());
	}

	public function get($request, $response, $args) {
    $user = User::find($args['id']);
		if (!$user) {
			return $response->withJson(["message"=>"User with ".$args['id']." doesn't exist."], 404);
		}
		return $response->withJson($user);
	}

	public function insert($request, $response) {
		/**
		 * TODO: Validate Form request
		 * If some error is there then throw error response
		 */
		$user = User::create([
				'name' => $request->getParsedBody()["name"],
				'email' => $request->getParsedBody()["email"],
        'rollno' => $request->getParsedBody()["rollno"],
        'phone' => $request->getParsedBody()["phone"],
        'company' => $request->getParsedBody()["company"]
			]);
		$user->save();
		return $response->withJson(["message"=>"User with ".$user->id." is created"], 201);
	}

	public function update($request, $response, $args) {
		$user = User::find($args['id']);
		if (!$user) {
			return $response->withJson(["message"=>"User with ".$args['id']." doesn't exist."], 404);
		}
    /**
		 * TODO: Validate Form request
		 * If some error is there then throw error response
		 */
		$user->name = $request->getParsedBody()["name"];
		$user->email = $request->getParsedBody()["email"];
    $user->phone = $request->getParsedBody()["phone"];
    $user->rollno = $request->getParsedBody()["rollno"];
		$user->company = $request->getParsedBody()["company"];
		$user->save();
		return $response->withJson(["message"=>"User with ".$args['id']." updated."], 200);
	}

	public function delete($request, $response, $args) {
		$deletedRows = User::find($args['id'])->delete();
		if (!$deletedRows)
			return $response->withJson(["message"=>"User with ".$args['id']." not found."], 404);
		return $response->withJson(["message"=>"User with ".$args['id']." deleted."], 204);
	}
}
