<div class="container my-4"> <a href="<?= $router->generate('student-add') ?>" class="btn btn-success float-right">Ajouter</a>

        <h2>Liste des &Eacute;tudiants</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Status</th>
                    <th scope="col">Teacher</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($viewData['studentList'] as $student) : ?>
                <tr>
                    <th scope="row"><?= $student->getId() ?></th>
                    <td><?= $student->getFirstname() ?></td>
                    <td><?= $student->getLastname() ?></td>
                    <td><?= $student->getStatus() == 1 ? 'Actif' : 'Inactif' ?></td>
                    <td><?php if($student->getTeacher_id() == 1) {
                     echo 'Baptiste';
                      } else if ($student->getTeacher_id() == 2) {
                          echo 'Stephane';
                      } else {
                          echo 'Pauline';
                      }?></td>
                    <td class="text-right">
                        <a href="<?= $router->generate('student-update', ['id' => $student->getId()]); ?>" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="<?= $router->generate('delete-student', ['id' => $student->getId()]) ?>">Oui, je veux
                                    supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>