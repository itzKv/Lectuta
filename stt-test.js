// npm install assemblyai

import { AssemblyAI } from 'assemblyai'

const client = new AssemblyAI({
  apiKey: "1b6435d5930847be973604f868675921"
})

const audioUrl =
  'https://storage.googleapis.com/aai-web-samples/5_common_sports_injuries.mp3'

const config = {
  audio_url: audioUrl
}

const run = async () => {
  const transcript = await client.transcripts.create(config)
  console.log(transcript.text)
}

run()