<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>IP Calculator</title>
    <meta name="author" content="Arthur REITER">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <?php 
    require("./inc/functions.php");
    require("./inc/head.php");
    ?>

    <section class="section">
        <div class="container">
            <h1 class="title">IP Calculator</h1>
            <h2 class="subtitle">
                A easy way to calculate all the necessary information about an <strong>IPv4 network</strong>.
            </h2>

            <form action="" method="get">
                <div class="field is-grouped">
                    <div class="control">
                        <input class="input" type="text" id="ip" name="ip" value="<?php echo $ip ?>"
                            pattern="(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)_*){3}"
                            require>
                    </div>
                    <div class="control">
                        <input class="input" type="text" id="slashnetmask" name="slashnetmask"
                            value="<?php echo $slashnetmask ?>" pattern="\/(\d){1,3}" require>
                    </div>
                    <div class="control">

                        <button type="submit" class="button is-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <table>
                <tr>
                    <td><b>Address:</b></td>
                    <td><?php echo $ip ?></td>
                    <td><?php echo get_pointed_ip($binary_ip); ?></td>
                </tr>
                <tr>
                    <td><b>Netmask:</b></td>
                    <td><?php echo $netmask . " = " . $netmask_size; ?></td>
                    <td><?php echo get_pointed_ip($binary_netmask); ?></td>
                </tr>
                <tr>
                    <td><b>Wildcard:</b></td>
                    <td><?php echo $wildcard; ?></td>
                    <td><?php echo get_pointed_ip($binary_wildcard); ?></td>
                </tr>

                <tr>
                    <td>=></td>
                </tr>

                <tr>
                    <td><b>Network:</b></td>
                    <td><?php echo $network; ?></td>
                    <td><?php echo get_pointed_ip($binary_network) . " (Class $net_class)"; ?> </td>
                </tr>
                <tr>
                    <td><b>Broadcast:</b></td>
                    <td><?php echo $broadcast ?></td>
                    <td><?php echo get_pointed_ip($binary_broadcast); ?>
                </tr>
                <tr>
                    <td><b>HostMin:</b></td>
                    <td><?php echo $hostmin ?></td>
                    <td><?php echo get_pointed_ip($binary_hostmin); ?></td>
                </tr>
                <tr>
                    <td><b>HostMax:</b></td>
                    <td><?php echo $hostmax ?></td>
                    <td><?php echo get_pointed_ip($binary_hostmax); ?></td>
                </tr>
                <tr>
                    <td><b>Hosts/Net:</b></td>
                    <td><?php echo $nbOfHosts; ?></td>
                    <td><?php echo $isPrivateNetwork; ?></td>
                </tr>
            </table>
        </div>
    </section>

    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                <strong>IP Calculator</strong> by <a href="https://reiter.tf">Arthur REITER</a>
            </p>
            <p>
            Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
            </p>
        </div>
    </footer>
</body>

</html>





