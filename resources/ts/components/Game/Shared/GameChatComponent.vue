<template>
    <div class="position-sticky">
        <form role="form">
            <div class="mb-3">
                <label for="game-log" class="sr-only">Game Log</label>
                <textarea
                    class="form-control form-control-lg"
                    id="game-log"
                    name="game-log"
                    style="resize: none"
                    placeholder="Game info will be displayed here."
                    disabled="disabled"
                    rows="20">
                </textarea>
            </div>
            <div class="mb-3">
                <label for="game-chat" class="sr-only">Game Chat</label>
                <textarea
                    class="form-control form-control-lg"
                    id="game-chat"
                    name="game-chat"
                    style="resize: none"
                    placeholder="Chat with your opponent here.">
                </textarea>
            </div>
            <div class="d-grid gap-2 mb-3">
                <button class="btn btn-primary btn-block" type="submit">Chat</button>
                <button class="btn btn-secondary btn-block" type="reset">Clear</button>
            </div>
        </form>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';

@Component
export default class GameChatComponent extends Vue {}
</script>
