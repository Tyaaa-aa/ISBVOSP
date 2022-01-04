<!DOCTYPE html>
<html>
<!-- HEAD CONTENT -->
<?php include "head.php" ?>
<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
<!-- Video.js base CSS -->
<link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet" />

<!-- City -->
<link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet" />

<body id="watch_body">
    <!-- HEADER CONTENT -->
    <?php include "header.php" ?>
    <!-- BODY CONTENT BELOW -->
    <section class="main_body">
        <!-- ===== TeleNode Content Dynamically Updated ===== -->
        <div class="main_content">
            <?php
            include "db_connect.php";
            $uuid = $_GET["id"];

            $result = $conn->query("SELECT v.*, u.userName,u.profileImg from tb_videos v inner join tb_users u on v.vid_userID=u.userID where v.vid_UID = '$uuid'");
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // Assign all user table content to variables for use later
                    $hasVid = true;
                    $getVid_id = $row['vid_id'];
                    $getVid_UID = $row['vid_UID'];
                    $getVid_userID = $row['vid_userID'];
                    $getVid_URLS = $row['vid_URLS'];
                    $getVid_ProjectData = $row['vid_projectData'];
                    $getVid_Name = $row['vid_name'];
                    $getVid_Description = $row['vid_description'];
                    $getVid_Thumbnail = $row['vid_thumbnail'];
                    $getVid_Visibility = $row['vid_visibility'];
                    $getVid_Status = $row['vid_status'];
                    $getVid_UploadTime = $row['vid_uploadTime'];
                    $getVid_Views = $row['vid_views'];

                    if ($getVid_Views == 0) {
                        $views = "No Views";
                    } else if ($getVid_Views == 1) {
                        $views = $getVid_Views . " View";
                    } else {
                        $views = $getVid_Views . " Views";
                    }

                    $profileImg = $row['profileImg'];
                    $getUsernames = $row['userName'];
                }

                if ($getVid_Visibility == "private" && $getVid_userID != $getUserID) {
                    $URL = "home.php#dashboard";

                    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                }
            ?>
                <div class="project_data" data-getVid_id='<?= $getVid_id ?>' data-getVid_UID='<?= $getVid_UID ?>' data-getVid_userID='<?= $getVid_userID ?>' data-getVid_URLS='<?= $getVid_URLS ?>' data-getVid_ProjectData='<?= $getVid_ProjectData ?>' data-getVid_Name='<?= $getVid_Name ?>' data-getVid_Description='<?= $getVid_Description ?>' data-getVid_Thumbnail='<?= $getVid_Thumbnail ?>' data-getVid_Visibility='<?= $getVid_Visibility ?>' data-getVid_Status='<?= $getVid_Status ?>' data-getVid_Views='<?= $getVid_Views ?>' data-getVid_UploadTime='<?= $getVid_UploadTime ?>'></div>
            <?php
            } else {
                $URL = "home.php#dashboard";

                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
            }
            ?>
            <!-- <video autoplay muted controls id="video_player" onerror="alert('Error Playing Video')"></video> -->

            <!-- poster="img/empty_thumbnail.png"  -->
            <div class="video_container">
                <video id="my-video" class="video-js vjs-theme-city vjs-16-9" controls preload="auto" data-setup="{}">
                    <!-- <!-- <source src="MY_VIDEO.mp4" type="video/mp4" /> -->
                    <!-- <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoyrides.mp4" type="video/webm" /> -->
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <div class="video_info">
                    <h2><?= $getVid_Name ?></h2>
                    <div class="video_details">
                        <p class="upload_day"><?= date("M jS, Y", strtotime($getVid_UploadTime)); ?></p>
                        <p class="view_count"><?= $views ?></p>
                    </div>





                    <p class="main_vid_description"><?= $getVid_Description ?></p>
                    <a href="user?id=<?= $getUsernames ?>" class="video_author">
                        <img src="<?= $profileImg ?>" alt="profile picture" class="author_image">
                        <p class="author_username"><?= $getUsernames ?></p>
                    </a>
                </div>
            </div>
            <!-- <button class="btn video_debug_btn" style="z-index: 999999999999;">DEBUG</button> -->
            <div id="dashboard-container">
                <?php
                // $sql = "SELECT * from tb_videos where vid_visibility = 'public' ORDER BY RAND ()";
                $uuid = $_GET["id"];

                $sql = "SELECT v.*, u.userName,u.profileImg from tb_videos v inner join tb_users u on v.vid_userID=u.userID where v.vid_visibility = 'public' AND v.vid_UID != '$uuid' ORDER BY RAND ()";

                include "populate_list.php";
                ?>

            </div>
        </div>
        <?php include "footer.php" ?>
    </section>
    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    <script src="js/tn-player.js?v=<?= time() ?>"></script>
    <script>
        collapseSidebar()
    </script>
</body>

</html>