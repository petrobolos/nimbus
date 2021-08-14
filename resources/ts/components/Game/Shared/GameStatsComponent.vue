<template>
    <div class="table-responsive text-center">
        <table class="table table-sm table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">HP</th>
                <th scope="col">SP</th>
                <th scope="col">Attack</th>
                <th scope="col">Defense</th>
                <th scope="col">Speed</th>
                <th scope="col">Special</th>
                <th scope="col">Spirit</th>
            </tr>
            </thead>
            <tbody class="table-striped">
            <tr>
                <th scope="row">You</th>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            <tr>
                <th scope="row">Opponent</th>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class GameStatsComponent extends Vue {}
</script>
