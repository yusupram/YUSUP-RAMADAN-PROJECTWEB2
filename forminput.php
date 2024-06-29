<?php
include "header.php";
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST["tanggal"];
    $shift = $_POST["shift"];
    $bagian = $_POST["bagian"];
    $operator = $_POST["operator"];
    $team = $_POST["team"];
    $no_so = $_POST["no_so"];
    $tanggal_so = $_POST["tanggal_so"];
    $project = $_POST["project"];
    $no_hp = $_POST["no_hp"];
    $type_barang = $_POST["type_barang"];
    $warna = $_POST["warna"];
    $deskripsi = $_POST["deskripsi"];

    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $upload_file = $upload_dir . basename($gambar);
    move_uploaded_file($gambar_tmp, $upload_file);

    $stmt = $conn->prepare("INSERT INTO laporan_harian (shift, tanggal, bagian, operator, team, no_so, tanggal_so, project, no_hp, type_barang, warna, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $shift, $tanggal, $bagian, $operator, $team, $no_so, $tanggal_so, $project, $no_hp, $type_barang, $warna, $deskripsi, $upload_file);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<main class="main bg-dark">
    <div class="container bg-dark text-light d-flex justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="form text-light px-5 py-4 border border-success rounded">
                <h5 class="mb-4">LAPORAN HASIL PROSES</h5>
                <form action="forminput.php" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">TANGGAL</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="col-md-6 ">
                            <label class="form-label ms-5">SHIFT</label><br>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="shift" id="shift1" value="1" required>
                                <label class="form-check-label" for="shift1">1</label>
                            </div>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input" type="radio" name="shift" id="shift2" value="2">
                                <label class="form-check-label" for="shift2">2</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="bagian" class="form-label">BAGIAN</label>
                            <select class="form-control" id="bagian" name="bagian">
                                <option value="" disabled selected>-pilih bagian-</option>
                                <option value="WRC-1">WRC-1</option>
                                <option value="WRC-2">WRC-2</option>
                                <option value="WRC-3">WRC-3</option>
                                <option value="WRC-4">WRC-4</option>
                                <option value="WRC-5">WRC-5</option>
                                <option value="WRC-6">WRC-6</option>
                                <option value="WRC-7">WRC-7</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="operator" class="form-label">OPERATOR</label>
                            <input type="text" class="form-control" id="operator" name="operator">
                        </div>
                        <div class="col-12">
                            <label for="team" class="form-label">TEAM</label>
                            <input type="text" class="form-control" id="team" name="team">
                        </div>
                        <div class="col-md-6">
                            <label for="no_so" class="form-label">No SO</label>
                            <input type="number" class="form-control" id="no_so" name="no_so">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_so" class="form-label">Tanggal SO</label>
                            <input type="date" class="form-control" id="tanggal_so" name="tanggal_so">
                        </div>
                        <div class="col-12">
                            <label for="project" class="form-label">Project</label>
                            <input type="text" class="form-control" id="project" name="project">
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>
                        <div class="col-md-6">
                            <label for="type_barang" class="form-label">Type Barang</label>
                            <input type="text" class="form-control" id="type_barang" name="type_barang">
                        </div>
                        <div class="col-12">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control" id="warna" name="warna">
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="gambar" class="form-label">Upload Gambar</label>
                            <input class="form-control" type="file" id="gambar" name="gambar" multiple>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100 mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <a class="text-decoration-none text-success mt-3 d-block" href="viewlaporan.php">
                            <i class="bi bi-arrow-left"></i> View
                        </a>
                    </div>
                    <div class="col-auto">
                        <a class="text-decoration-none text-success mt-3 d-block text-end" href="home.php">
                            Back to Home <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "footer.php";?>
