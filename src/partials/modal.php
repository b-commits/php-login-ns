<?php

include_once "header.php" ?>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit user details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="controllers/Users.php" method="POST">
                    <input type="hidden" name="type" value="edit">
                    <input type="hidden" class="id" name="id" value="edit">
                    <div class="form-row">
                        <div class="col">
                            <label for="full_name">Full name</label>
                            <input name="full_name" class="full_name" type="text">
                        </div>
                        <div class="col">
                            <label for="username">Username</label>
                            <input name="username" class="username" type="text">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="email">Email</label>
                            <input name="email" class="email" type="text">
                        </div>
                        <div class="col">
                            <label for="phone">Phone Number</label>
                            <input name="phone" class="phone" type="text">
                        </div>
                    </div>
                    <label class="gender-label" for="full_name">Gender</label>
                    <select name="gender" class="form-select form-select-sm" aria-label="Default select example">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/modal_fill.js"></script>
</div>


