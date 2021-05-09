<main>
    <h2>Welcome, <strong><?= $user->name ?></strong>.</h2>
    <h3>Stats</h3>
    <table role="grid">
        <thead>
            <tr>
                <th>Table name</th>
                <th style="text-align: center;">All</th>
                <th style="text-align: center;">Actives</th>
                <th style="text-align: center;">Inactives</th>
            </tr>
        </thead>
        <tbody>
            <?php

            /**
             * @var \src\models\Dashboard $table
             */
            foreach ($stats as $table) : ?>
                <tr>
                    <td style="width: 70%">{{ $tableName }}</td>
                    <td style="text-align: center;"><?= $table->all ?></td>
                    <td style="text-align: center;"><?= $table->actives ?></td>
                    <td style="text-align: center;"><?= $table->inactives ?></td>
                </tr>
            <?php endforeach; ?>
            </tboby>
    </table>
</main>