<div>
    <h2>LONGIN</h2>
    <form action="<?php echo URL;?>Home/identifyUser" method = "POST">
        <label>Email</label>
        <input type="text" name="email" value="" required/>
        <label>Password</label>
        <input type="password" name="pwd" value="" required/>
        <input type="submit" name="submit" value = "OK"/>
    </form>
</div>