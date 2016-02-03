<?php
/**
 * Created by PhpStorm.
 * User: triasbrata
 * Date: 1/21/16
 * Time: 6:15 AM
 */

namespace Bitdev\ModuleGenerator\Http\Controllers;


use Bitdev\ModuleGenerator\Contracts\ModelInterface;
use Illuminate\Http\Request;

interface BitdevControllerInterface
{
    /**
     * @param ModelInterface $repo
     * @param Request $request
     * @param $from
     * @return mixed
     */
     public function  createOrUpdate($repo, $request, $form);

    /**
     * @param ModelInterface $repo
     * @return mixed
     */
    public  function destroy($repo);
}