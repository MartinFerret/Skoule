<div class="container my-4">
    <p class="display-4">
        Bienvenue dans le backOffice <strong>Skoule</strong>...
    </p>

    <div class="row mt-5">
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des professeurs</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>                                
                                <th scope="col">Prénom</th>                                
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($teachers as $teacher): ?>
                            <tr>
                                <th scope="row"><?= $teacher->getId() ?></th>
                                <td><?= $teacher->getFirstname() ?></td>
                                <td><?= $teacher->getLastname() ?></td>
                                <td class="text-end">
                                    <a href="" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="dropdown">Oups !</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <a href="<?= $router->generate('teacher-list') ?>" class="btn btn-success">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card text-white mb-3">
                <div class="card-header bg-primary">Liste des étudiants</div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($students as $student): ?>
                            <tr>
                                <th scope="row"><?= $student->getId() ?></th>
                                <td><?= $student->getFirstname() ?></td>
                                <td><?= $student->getLastname() ?></td>
                                <td class="text-end">
                                    <a href="" class="btn btn-sm btn-warning">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                    <!-- Example single danger button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="dropdown">Oups !</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <a href="<?= $router->generate('student-list') ?>" class="btn btn-success">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>