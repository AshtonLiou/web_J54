<?php include_once "./api/db.php";

    $sql = "SELECT * FROM `tickets`";
    $rows = $pdo -> query($sql) -> fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TableSheet</title>
    <link rel="shortcut icon" href="./img/FIBEX_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./bootstrap/bootstrap.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <svg class="fixedTop" width="650" height="400">
        <polygon points="0,0 650,0 650,400 550,100" style="fill:#4a6783;"></polygon>
    </svg>
    <svg class="fixedBottom" width="650" height="400">
        <polygon points="0,0 0,400 650,400 100,300" style="fill:#4a6783;"></polygon>
    </svg>

    <!-- navbar -->

    <nav class="container">
        <img src="./img/FIBEX_logo.png" style="height: 4vh; margin: 2vh 2vw; transform: scale(2);" alt="logo">
        <a href="./home.html">Home</a>
        <a href="./news.html">News</a>
        <a href="./business.html">Business</a>
        <a href="./tickets.html">Tickets</a>
        <a href="./tablesheet.php" class="nowNav">TableSheet</a>
    </nav>

    <main>

        <table class="container table table-striped table-light table-bordered table-hover shadow mt-5"
            style="font-weight: 700;">

            <thead class="thead-dark">
                <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Button</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($rows as $record) { ?>
                <tr>
                    <th class="d-none">
                        <?= $record["id"]; ?>
                    </th>
                    <td>
                        <?= $record["fname"]; ?>
                    </td>
                    <td>
                        <?= $record["lname"]; ?>
                    </td>
                    <td>
                        <?= $record["phone"]; ?>
                    </td>
                    <td>
                        <?= $record["pw"]; ?>
                    </td>
                    <td class="w-25">
                        <button class="btn warningBtn" onclick="editRecord(<?= $record['id']; ?>)">Edit (編輯)</button>
                        <button class="btn dangerBtn" onclick="delRecord(<?= $record['id']; ?>)">Delete (刪除)</button>
                    </td>
                </tr>
                <?php }; ?>
            </tbody>

        </table>

        <div id="editForm">

            <form action="./api/edit.php" method="post" class="p-5 shadow"
                style="width: 40vw; background-color: rgba(255, 255, 255, .5);">

                <button type="button" class="btn rootBtn" onclick="goback()">Go back</button>

                <h1 class="text-center">EDIT</h1>

                <input type="hidden" name="eid">

                <div class="form-row mt-4">
                    <div class="col">
                        <input type="text" class="form-control" name="efname" placeholder="First name (名字)" required>
                        <div class="invalid-tooltip" style="opacity: .5;">Please provide your first name.</div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="elname" placeholder="Last name (姓氏)" required>
                        <div class="invalid-tooltip" style="opacity: .5;">Please provide your last name.</div>
                    </div>
                </div>

                <div class="form-row mt-5">
                    <div class="col">
                        <input type="tel" class="form-control" name="ephone" placeholder="Phone (手機號碼)" required>
                        <div class="invalid-tooltip" style="opacity: .5;">Please provide your phone number.</div>
                    </div>
                    <div class="col">
                        <input type="password" class="form-control" name="epw" placeholder="Password (會員密碼)" required>
                        <div class="invalid-tooltip" style="opacity: .5;">Please provide your password.</div>
                    </div>
                </div>

                <div class="form-row mt-5">
                    <button type="button" class="btn rootBtn col-10 mx-auto" style="height: 5vh;"
                        onclick="editSubmit()">Edit submit (編輯送出按鈕)</button>
                </div>

            </form>

        </div>

    </main>

    <!-- footer -->

    <footer class="text-center text-white p-2" style="background-color: #4a6783;">
        <img src="./img/facebook.png" style="height: 40px;" alt="facebook">
        <span>Copyright &copy; 2024 FIBEX All Rights Reserved</span>
        <img src="./img/google.png" style="height: 40px;" alt="google">
    </footer>

    <!-- script -->

    <script src="./jquery/jquery.js"></script>
    <script src="./bootstrap/bootstrap.js"></script>
    <script>

        $("a[href='./tablesheet.php']").hover(
            function () {
                $(this).css("animation-name", "lnowNav")
            },
            function () {
                $(this).css("animation-name", "nowNav")
            }
        )

        function editRecord(id) {
            $("#editForm").fadeIn(200).css("display", "flex")
            $("input[name='eid']").val(id)
            $.getJSON("./api/get.php", { id: id }, (data) => {
                $("input[name='eid']").val(data.id)
                $("input[name='efname']").val(data.fname)
                $("input[name='elname']").val(data.lname)
                $("input[name='ephone']").val(data.phone)
                $("input[name='epw']").val(data.pw)
            })
        }

        function editSubmit() {
            if ($("form")[0].reportValidity()) {
                $.post("./api/edit.php", $("#editForm>form").serialize(), () => {
                    location.reload()
                })
            } else {
                $("form").addClass("was-validated")
            }
        }

        function goback() {
            $("#editForm").fadeOut(200)
            $("form").removeClass("was-validated")
        }

        function delRecord(id) {
            $.post("./api/del.php", { id: id }, () => {
                location.reload()
            })
        }

    </script>

</body>

</html>