<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

namespace Kni\Presentation\Repository;

interface PresentationRepositoryInterface
{
    public function findAll();
    public function findByUser();
    public function find($id);
    public function existsWithSlug($slug);
    public function findBySlug($slug);
}