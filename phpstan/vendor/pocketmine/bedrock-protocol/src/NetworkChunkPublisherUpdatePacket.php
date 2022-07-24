<?php

/*
 * This file is part of BedrockProtocol.
 * Copyright (C) 2014-2022 PocketMine Team <https://github.com/pmmp/BedrockProtocol>
 *
 * BedrockProtocol is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace pocketmine\network\mcpe\protocol;

use pocketmine\network\mcpe\protocol\serializer\PacketSerializer;
use pocketmine\network\mcpe\protocol\types\BlockPosition;

class NetworkChunkPublisherUpdatePacket extends DataPacket implements ClientboundPacket{
	public const NETWORK_ID = ProtocolInfo::NETWORK_CHUNK_PUBLISHER_UPDATE_PACKET;

	public BlockPosition $blockPosition;
	public int $radius;

	/**
	 * @generate-create-func
	 */
	public static function create(BlockPosition $blockPosition, int $radius) : self{
		$result = new self;
		$result->blockPosition = $blockPosition;
		$result->radius = $radius;
		return $result;
	}

	protected function decodePayload(PacketSerializer $in) : void{
		$this->blockPosition = $in->getSignedBlockPosition();
		$this->radius = $in->getUnsignedVarInt();
	}

	protected function encodePayload(PacketSerializer $out) : void{
		$out->putSignedBlockPosition($this->blockPosition);
		$out->putUnsignedVarInt($this->radius);
	}

	public function handle(PacketHandlerInterface $handler) : bool{
		return $handler->handleNetworkChunkPublisherUpdate($this);
	}
}
