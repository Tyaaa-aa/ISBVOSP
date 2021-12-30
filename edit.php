<!DOCTYPE html>
<html>
<!-- HEAD CONTENT -->
<?php include "head.php" ?>

<body>
    <!-- HEADER CONTENT -->
    <?php include "header.php" ?>
    <!-- BODY CONTENT BELOW -->
    <section class="main_body edit_page">
        <div class="main_content">
            <div class="steps_bar">
                <!-- <h2>Create New Project</h2> -->
                <div class="steps_container">
                    <div class="steps steps_one steps_number_active">
                        <h3 class="steps_number">1</h3>
                        <span>Videos</span>
                    </div>
                    <div class="steps steps_two steps_number_active">
                        <h3 class="steps_number">2</h3>
                        <span>Create</span>
                    </div>
                    <div class="steps steps_three">
                        <h3 class="steps_number">3</h3>
                        <span>Publish</span>
                    </div>
                </div>
                <button class="publish_btn btn" title="Publish Project">
                    <span class="material-icons">
                        publish
                    </span>
                    <span>Publish</span>
                </button>
                <button class="save_btn btn" title="Save Project">
                    <span class="material-icons">
                        save
                    </span>
                    <span>Save</span>
                </button>
                <span class="save_msg save_msg_closed">Project saved!</span>
                <!-- <button class="jsondebug btn" style="position:fixed;bottom:5%;right:2%;z-index:99999;">(Download Current Data)</button> -->
            </div>
            <div class="create_container">
                <?php
                include "db_connect.php";
                $uuid = $_GET["id"];

                $result = $conn->query("SELECT * from tb_videos where vid_UID = '$uuid'");
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Assign all user table content to variables for use later
                        $hasVid = true;
                        $getVid_id = $row['vid_id'];
                        $getVid_userID = $row['vid_userID'];
                        $getVid_URLS = $row['vid_URLS'];
                        $getVid_ProjectData = $row['vid_projectData'];
                        $getVid_Name = $row['vid_name'];
                        $getVid_Description = $row['vid_description'];
                        $getVid_Thumbnail = $row['vid_thumbnail'];
                        $getVid_Visibility = $row['vid_visibility'];
                        $getVid_Status = $row['vid_status'];
                        $getVid_UploadTime = $row['vid_uploadTime'];
                    }

                    $URL = "home.php#dashboard";
                    if (!isset($_SESSION["userID"])) {
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                    } else if ($_SESSION["userID"] != $getVid_userID) {
                        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                    }

                ?>

                    <div class="edit_container">
                        <!-- <div class="projects_box_container"> -->
                        <div class="projects_box " data-getVid_id='<?= $getVid_id ?>' data-getVid_userID='<?= $getVid_userID ?>' data-getVid_URLS='<?= $getVid_URLS ?>' data-getVid_ProjectData='<?= $getVid_ProjectData ?>' data-getVid_Name='<?= $getVid_Name ?>' data-getVid_Description='<?= $getVid_Description ?>' data-getVid_Thumbnail='<?= $getVid_Thumbnail ?>' data-getVid_Visibility='<?= $getVid_Visibility ?>' data-getVid_Status='<?= $getVid_Status ?>' data-getVid_UploadTime='<?= $getVid_UploadTime ?>'>
                            <h3 id="projects_box_title"><?= $getVid_Name ?><span class="vid_counter"></span></h3>
                            <div class="projects_box_toolbar">
                                <div class="toolbar_btns_container">
                                    <span class="material-icons card_view_btn toolbar_btns toolbar_btns_active" title="Card View">
                                        view_agenda
                                    </span>
                                    <span class="material-icons list_view_btn toolbar_btns" title="List View">
                                    format_list_bulleted
                                    </span>
                                    <span class="material-icons edit_videos_btn toolbar_btns" title="Edit Videos">
                                        edit
                                    </span>
                                </div>
                                <div class="toolbar_search">
                                    <input type="text" placeholder="Search" class="search_input input_field">
                                    <!-- <button type="button"value="Submit" class="search_btn">
                                        <i class="material-icons">search</i>
                                    </button> -->
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
                        <div class="edit_projects">
                            <div class="project_blocks project_blocks_starter">
                                <span class="parent_indicator">
                                    <div class="pi_dot starter_dot">
                                        <span class="material-icons">
                                            play_arrow
                                        </span>
                                        <p>Starting question</p>
                                    </div>
                                </span>

                                <div class="block_video block_box">
                                    <div class="video_cards_container">
                                        <input type="text" placeholder="Choose a video (drag and drop)" class="input_field question_field">
                                        <div class="video_cards">
                                            <div class="thumbnail-box">
                                                <img class="thumbnail" src="img/empty_thumbnail.png" alt="Thumbnail">
                                            </div>
                                            <h4 class="video_title"> </h4>
                                        </div>
                                    </div>
                                    <div class="input_container">
                                        <input type="text" placeholder="Question/Prompt" class="input_field question_title">
                                        <div class="dropbtn_container">
                                            <input type="text" class="input_field dropbtn" placeholder="Choose a video" onkeypress="return false;" readonly data-videoid="">
                                            <span class="material-icons">
                                                expand_more
                                            </span>
                                            <div class="dropdown_content">
                                                <!-- <div class="dropdown_option" data-title="" data-videoid="">-- Select an option --</div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="block_questions_container">
                                    <div class="block_questions block_box">
                                        <input type="text" placeholder="Option 1" class="input_field options_field">
                                        <div class="dropbtn_container">
                                            <input type="text" class="input_field dropbtn" placeholder="Choose a video" onkeypress="return false;" readonly>
                                            <span class="material-icons">
                                                expand_more
                                            </span>
                                            <div class="dropdown_content">
                                                <!-- <div class="dropdown_option" data-title="" data-videoid="">-- Select an option --</div> -->
                                            </div>
                                        </div>

                                        <div class="video_cards_container">
                                            <input type="text" placeholder="Choose a video (drag and drop)" class="input_field question_field">
                                            <div class="video_cards">
                                                <div class="thumbnail-box">
                                                    <img class="thumbnail" src="img/empty_thumbnail.png" alt="Thumbnail">
                                                </div>
                                                <h4 class="video_title"> </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block_questions block_box">
                                        <input type="text" placeholder="Option 1" class="input_field options_field">
                                        <div class="dropbtn_container">
                                            <input type="text" class="input_field dropbtn" placeholder="Choose a video" onkeypress="return false;" readonly>
                                            <span class="material-icons">
                                                expand_more
                                            </span>
                                            <div class="dropdown_content">
                                                <!-- <div class="dropdown_option" data-title="" data-videoid="">-- Select an option --</div> -->
                                            </div>
                                        </div>

                                        <div class="video_cards_container">
                                            <input type="text" placeholder="Choose a video (drag and drop)" class="input_field question_field">
                                            <div class="video_cards">
                                                <div class="thumbnail-box">
                                                    <img class="thumbnail" src="img/empty_thumbnail.png" alt="Thumbnail">
                                                </div>
                                                <h4 class="video_title"> </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block_questions block_box">
                                        <input type="text" placeholder="Option 1" class="input_field options_field">
                                        <div class="dropbtn_container">
                                            <input type="text" class="input_field dropbtn" placeholder="Choose a video" onkeypress="return false;" readonly>
                                            <span class="material-icons">
                                                expand_more
                                            </span>
                                            <div class="dropdown_content">
                                                <!-- <div class="dropdown_option" data-title="" data-videoid="">-- Select an option --</div> -->
                                            </div>
                                        </div>

                                        <div class="video_cards_container">
                                            <input type="text" placeholder="Choose a video (drag and drop)" class="input_field question_field">
                                            <div class="video_cards">
                                                <div class="thumbnail-box">
                                                    <img class="thumbnail" src="img/empty_thumbnail.png" alt="Thumbnail">
                                                </div>
                                                <h4 class="video_title"> </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- <img src="img/create_placeholder.png" alt="Placeholder" style=" position: absolute;top: 15%;left: 30%;width: 50%;"> -->
            </div>
        </div>
        <?php include "footer.php" ?>

    </section>
    <script>
        collapseSidebar();

        // Can we change this to pure php later? There is really no point in using javascript to populate this list at all. The data in the parent div can stay but the populating should remain in pure PHP.....
        // ============================================================
        // Find a way to make the data only on parent div and not repeat on listed items
        listYTVideos($(".projects_box"), true)
        populateProjectData($(".projects_box"))

        $(".publish_btn").click(function() {
            $(".create_container").html(`<form action="publish.php" method="POST" class="publish_form">
            <input type="text" placeholder="Project Name" class="input_field upload_input_field" name="project_name" required>
            <input type="text" placeholder="Project Description" class="input_field upload_input_field" name="project_description" required>
            <div>
                <input type="radio" id="public" name="visibility" value="public">
                <label for="public">Public</label><br>
                <input type="radio" id="unlisted" name="visibility" value="unlisted">
                <label for="unlisted">Unlisted</label><br>
                <input type="radio" id="private" name="visibility" value="private">
                <label for="private">Private</label>
            </div>

            <input type="hidden" value="<?= $getVid_id ?>" name="videoUUID">
            <input type="submit" value="Submit" class="btn">
            </form>`)

            $(".steps_three").addClass("steps_number_active");
            $(".publish_btn").remove();
        })


        // UPDATE THUMBNAIL IMAGE FOR PUBLISHING (NOT DONE YET)
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var filepath = e.target.result
                    //Change Target Image
                    $(".account_pic").css("background", "url(" + filepath + ")")
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        // Image Trigger
        $("#upload-img").change(function() {
            readURL(this);
        });
    </script>
</body>

</html>