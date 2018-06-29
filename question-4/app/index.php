<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BDR - Knowledge test</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">


        <style>
            body {
                background-color: #EEE;
            }
            .title {
                font-family: Calibri;
                font-size: 38px;
                width: 100%;
                text-align: center;
                margin-top: 80px;
                color: #444;
            }
            .center {
                position: absolute;
                width: 100%;
                top: 35%;
                text-align: center;
            }
            .center .actions {
                margin-bottom: 30px;
            }
            .center button {
                padding: 15px 40px;
                margin: 30px;
            }
            .description {
                text-align: center;
            }


        </style>

    </head>
    <body ng-app="app" ng-controller="controller">
        <div class='title'>BDR - Knowledge test</div>
        <div class="center">
            <div class="actions">

                <button ng-click='initialize()' 
                        class="btn btn-md btn-success m-t">Carregar base</button>

                <button ng-click='createTask("Task created","Task description", "5")' 
                        class="btn btn-md btn-success m-t">Criar nova (model)</button>

                <button ng-click='firstToLast()' 
                        class="btn btn-md btn-primary m-t">Alterar prioridade do 1º para último</button>

                <button ng-click='lastToFirst()' 
                        class="btn btn-md btn-danger m-t">Alterar prioridade do último para 1º</button>

                <button ng-click='deleteLastTask()' 
                        class="btn btn-md btn-info m-t">Excluir</button>
            </div>
            <div>
                <table class="table tasks">
                    <tr ng-repeat="task in tasks">
                        <td ng-bind="task.idtask"></td>
                        <td ng-bind="task.title"></td>
                        <td ng-bind="task.description"></td>
                        <td ng-bind="task.priority"></td>
                    </tr>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script type="text/javascript">

            var app = angular.module('app', []);
            app.controller('controller', function($scope, $http) {
                
                $scope.initialize = function () {
                    $scope.promisse = $http({
                        method: 'GET',
                        url: 'http://localhost/bdr/question-4/app/api/taks/initialize.php'
                    }).then(function (dados) {
                        $scope.getTasks();
                    });
                };

                $scope.getTasks = function () {
                    $scope.promisse = $http({
                        method: 'GET',
                        url: 'http://localhost/bdr/question-4/app/api/taks/read.php'
                    }).then(function (dados) {
                        $scope.tasks = dados.data.tasks;
                    });
                };

                $scope.createTask = function (title, description, priority) {
                    $scope.promisse = $http({
                        method: 'POST',
                        url: 'http://localhost/bdr/question-4/app/api/taks/create.php',
                        data: {'title': title, 'description': description, 'priority': priority}
                    }).then(function (dados) {
                        $scope.getTasks();
                    });
                };

                $scope.firstToLast = function() {
                    let idtask = $scope.tasks[0].idtask;
                    let priority = parseInt($scope.tasks[$scope.tasks.length - 1].priority) + 1;

                    $scope.changePriority(idtask, priority);
                };

                $scope.lastToFirst = function() {
                    let idtask = $scope.tasks[$scope.tasks.length - 1].idtask;
                    let priority = parseInt($scope.tasks[0].priority) - 1;

                    $scope.changePriority(idtask, priority);
                }

                $scope.changePriority = function (idtask, priority) {
                    $scope.promisse = $http({
                        method: 'POST',
                        url: 'http://localhost/bdr/question-4/app/api/taks/update.php',
                        data: {'idtask': idtask, 'priority': priority}
                    }).then(function (dados) {
                        $scope.getTasks();
                    });
                };

                $scope.deleteLastTask = function () {
                    let idtask = $scope.tasks[$scope.tasks.length - 1].idtask;
                    $scope.promisse = $http({
                        method: 'POST',
                        url: 'http://localhost/bdr/question-4/app/api/taks/delete.php',
                        data: {'idtask': idtask}
                    }).then(function (dados) {
                        $scope.getTasks();
                    });
                };

                $scope.getTasks();

            });

        </script>

    </body>
</html>